<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title>Results</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
      // Load the Visualization API.
      google.charts.load('current', {'packages':['corechart']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart2);
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
          
      function drawChart() {
        var data = new google.visualization.DataTable(<?=$jsonTable?>);
      
        // Set chart options
        var options = {'title':'Hits by Location',
          'width':400, 'height':300};
      
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('bar_div'));
        chart.draw(data, options);
      }

        function drawChart2() {
        var data = new google.visualization.DataTable(<?=$jsonTable2?>);
      
        // Set chart options
        var options = {'title':'Hits by Website',
          'width':400, 'height':300};
      
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('bar_div2'));
        chart.draw(data, options);
      }

    </script>
    <!--Div that will hold the bar graph-->
    <table class="columns">
      <tr>
        <td><div id="bar_div"></div></td>
        <td><div id="bar_div2"></div></td>
      </tr>
    </table>
    
</head>
<body>