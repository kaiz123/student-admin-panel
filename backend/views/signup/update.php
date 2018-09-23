<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Signup */

$this->title = 'Update Signup: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Signups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="signup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_login' => $model_login,
    ]) ?>

</div>
