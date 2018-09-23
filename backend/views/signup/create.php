<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Signup */

$this->title = 'Create Signup';
$this->params['breadcrumbs'][] = ['label' => 'Signups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_login' => $model_login,
    ]) ?>

</div>
