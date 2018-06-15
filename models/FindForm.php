<?php
   namespace app\models;
   use Yii;
   use yii\base\Model;
   class FindForm extends Model {
      public $ip;
     /**
      * @inheritdoc
      */
    public function rules()
    {
        return [
            [['ip'],'ip']
        ];
    }
      /**
      * @return array customized attribute labels
      */
      public function attributeLabels() {
         return [
            'ip' => 'IP',
         ];
      }
   }
?>