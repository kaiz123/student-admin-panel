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


    <p>
        <?= $show_buttons!=FALSE?Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']): "" ?>
        <?= $show_buttons!=FALSE?Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : "" ?>
    </p>
    <h1>Profile Picture</h1>
    <img src="<?= Yii::$app->request->baseUrl . 'uploads/' . $model->id . '.jpg' ?>" class=" img-responsive" >


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'email:email',
            'mobile',
            'state',
            'city',
            'location',
            'dob',
            'gender',
            [    
            'attribute'=>'username',
            'value'=>$model_login->username,
            ],
            [    
            'attribute'=>'password',
            'value'=>$model_login->password,
            ],
            
        ],
    ]) ?>


</div>
