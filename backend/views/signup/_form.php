<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\State;
use kartik\file\FileInput;
$stateList=ArrayHelper::map(State::find()->all(),'gt_id','gt_state');

/* @var $this yii\web\View */
/* @var $model app\models\Signup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="signup-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList($stateList, ['id'=>'state-id']) ?>

    <?= $form->field($model, 'city')->widget(DepDrop::classname(), [
    'options'=>['id'=>'city-id'],
    'pluginOptions'=>[
        'depends'=>['state-id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/signup/city'])
    ]]) ?>

    <?= $form->field($model, 'location')->widget(DepDrop::classname(), [
    'pluginOptions'=>[
        'depends'=>['state-id', 'city-id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/signup/location'])
    ]]); ?>

    <?= $form->field($model, 'dob')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true]]) ?>

    <span style="font-weight: bold;">Gender</span>
    <?= $form->field($model, 'gender')->radio(['label' => 'male', 'value' => 0, 'uncheck' =>null]) ?>
    <?= $form->field($model, 'gender')->radio(['label' => 'female', 'value' => 1, 'uncheck' =>null]) ?>

    <?= $form->field($model_login, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_login, 'password')->passwordInput(['maxlength' => true]) ?> 


    <?= $form->field($model, 'Profile_Pic')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],'pluginOptions' => [
        'initialPreview' => Yii::$app->controller->action->id== "update" ?[
            Html::img("@web/uploads/".$model->id.".jpg",['width'=>'100%','height'=>'100%']),
        ]: ""
     ]]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
