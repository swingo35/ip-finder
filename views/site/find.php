<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Find';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title>Find</title>
    <div class = "row">
        <div class = "col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'ip-form',
                'method' => 'post',
                'action' => ['search']
            ]);?>
            <?= $form->field($model, 'ip') ?>
            <div class = "form-group">
         <?= Html::submitButton('Seach', ['class' => 'btn btn-primary',
            'name' => 'ip-button']) ?>
      </div>
      <?php ActiveForm::end(); ?>
   </div>
</div>
</head>
</html>>