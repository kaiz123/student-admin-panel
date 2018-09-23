<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Signups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

<h1>Welcome To The Website</h1>

    <div style="display:flex;margin-top: 20%;margin-left: 20%">

    <p>

        <?= Html::a('Signup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    </div>

    <div style="display:flex;margin-top: 2%;margin-left: 20%">
    <p>
        <?= Html::a('Login', ['login/login'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>


</div>
