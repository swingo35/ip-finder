<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Logs;
use app\models\FindForm;
use app\models\Locations;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
     /**
     * Function that compares an ip from the access list to an ip from the database
     * 
     * @param ip1 The ip from the access list
     * @param ip2 The ip from the database
     * @return 1 if they are the same and returns 0 if they are different
     */
    private static function checkip($ip1, $ip2){
        list($ip1q1, $ip1q2, $ip1q3, $ip1q4 ) = explode(".", $ip1);
        list($ip2q1, $ip2q2, $ip2q3, $ip2q4 ) = explode(".", $ip2);
        // Check first q 
        if(strcmp($ip1q1,$ip2q1) == 0){
            if(strcmp($ip1q2,$ip2q2) == 0 || strcmp($ip2q2,"*") == 0){
                if(strcmp($ip1q3,$ip2q3) == 0 || strcmp($ip2q3,"*") == 0){
                    if(strcmp($ip1q4,$ip2q4) == 0 || strcmp($ip2q4,"*") == 0){
                        return 1;
                    }
                }
            }
        }
        return 0;
    }

    /**
     * Pass the logs and locations to the view
     */
    public function actionIndex() {
        $logs = Logs::find()->all();

        $locations = Locations::find()->all();

        // Display the Logs
        return $this->render('index', [
            'logs' => $logs,
            'locations' => $locations,
        ]);
    }


    /**
     * Create a graph based on the number of hits by location
     * And create a graph based on the number of hits by website
     */
    public function actionResults() {
        $logs = Logs::find()->all();

        $locations = Locations::find()->all();

        $accessArray = array();

        //Create the database array
        $dbArray = array();


        // Read in the access log file line by line and break it into ip and other info.
        // Then store in in a 2d array
        foreach ($logs as $tempString ) {
            $list = explode(" - - ", $tempString->log);
            sscanf($list[1], '[%[^]]] "%s %s %[^"]" %d - %s "%[^"]"', $time, $method, $uri
              ,$code, $protocol, $website , $other);
            // Check if 404 and if it is throw it out
            if($protocol == 404){
                continue;
            }
      
            // NOTE this step was just incase I wanted to print a "nice" website
            // Check if spider and if it is fix the website
            if (strcmp($website, '"-"') == 0) {
                $plus = strpos($other, "+");
                $website  = substr($other, $plus+3);
                $com = strpos($website, ".com");
                $website = substr($website, 7, $com - 3);
            }
            else {
                $com = strpos($website, ".com");
                $website = substr($website, 8, $com - 4);
            }
                // Add it to the add and get the next line
                $accessArray[] = array($list[0], $website);
        }

        // Read in the Database file
        foreach ($locations as $tempString) {
           $list = explode(":", $tempString->loc);
           $dbArray[] = array($list[0], $list[1]);
        }

        // Initialize the array to keep track of hits
        $numArr = array_fill(0, count($dbArray), 0);
        // Initialize the array to keep track of hits
        $webArr = array_fill(0, count($dbArray), "");
        // For loop to check for accesslist against database
        for ($x = 0; $x < count($accessArray); $x++) {
            for($y = 0; $y < count($dbArray); $y++){
                if($this::checkip($accessArray[$x][0], $dbArray[$y][0]) == 1){
                    $numArr[$y] += 1;

                    break;
                }
            }
        }   

        // Create table for graph
        $table = array();
        $rows = array();
        $table['cols'] = array(
            // Labels for the chart for column titles
            array('label' => 'Location', 'type' => 'string'),
            array('label' => 'Hits', 'type' => 'number')
        );

        // Create nice looking table 
        for($y = 0; $y < count($dbArray); $y++){
            $temp = array();
            // Locations for data
            $temp[] = array('v' => (string) $dbArray[$y][1]); 
      
            // Number of hits per location for data
            $temp[] = array('v' => (int) $numArr[$y]); 
            $rows[] = array('c' => $temp);
        } 
        // Create table
        $table['rows'] = $rows;
        // Json encode it for the google chart
        $jsonTable = json_encode($table);


        // Create table for graph
        $webTable = array();
        $webRows = array();
        $webTable['cols'] = array(
            // Labels for the chart for column titles
            array('label' => 'Location', 'type' => 'string'),
            array('label' => 'Hits', 'type' => 'number')
        );

        $tempTable = array_column($accessArray,1);
        $tempTable2 = array_count_values($tempTable);

        $tempTableKeys = array_keys($tempTable2);

        // Create nice looking table 
        for($y = 0; $y < count($tempTable2); $y++){
            $temp = array();
            // Locations for data
            $temp[] = array('v' => (string) $tempTableKeys[$y]); 
      
            // Number of hits per location for data
            $temp[] = array('v' => (int) $tempTable2[$tempTableKeys[$y]]); 
            $webRows[] = array('c' => $temp);
        } 
        // Create table
        $webTable['rows'] = $webRows;
        $jsonTable2 = json_encode($webTable);

        // Display the Logs
        return $this->render('results', [
            'jsonTable' => $jsonTable,
            'jsonTable2' => $jsonTable2,
        ]);
    }

    public function actionFind() {
        $form = new FindForm();
        return $this->render('find', ['model' => $form]);
    }
    // Go to the website and get the info about the given ip
    public function actionSearch() {
        $model = new FindForm();
        if( $model->load(Yii::$app->request->post())){
            // Get the ip from the form
            $user_ip = $model['ip'];
            // Use the geo plugin site and unpack the results into $geo
            $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
            $city = $geo["geoplugin_city"];
            $region = $geo["geoplugin_regionName"];
            $country = $geo["geoplugin_countryName"];

            // Display the Logs
            return $this->render('findResults', [
                'city' => $city,
                'region' => $region,
                'country' => $country,
            ]);
        }
    }
}
