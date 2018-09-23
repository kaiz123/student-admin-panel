<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Login;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Signup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Signups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup-view">
       <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'email:email',
            'mobile',
            //'state',
            //'city',
            //'location',
            //'dob',
            //'gender',
            //'username',
            //'password',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ])?>

</div>
