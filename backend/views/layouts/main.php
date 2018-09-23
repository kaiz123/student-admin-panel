<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
$type=SideNav::TYPE_DEFAULT;
$item = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="background: url(uploads/grow.jpeg);">
    <div class="container">
        <div class="row">
            <div class="col-sm-3" style="height:500px;">
                <?php 
                // $role=\Yii::$app->user->identity->Role;
                // print($role);
                // die();
                    echo SideNav::widget([

                'type' => SideNav::TYPE_PRIMARY,
                'encodeLabels' => false,
                'heading' => "Operations",
                'items' => [
                    // Important: you need to specify url as 'controller/action',
                    // not just as 'controller' even if default action is used.
                    //
                    // NOTE: The variable `$item` is specific to this demo page that determines
                    // which menu item will be activated. You need to accordingly define and pass
                    // such variables to your view object to handle such logic in your application
                    // (to determine the active status).
                    //
                    ['label' => 'Home', 'icon' => 'home', 'url' => Url::to(['/signup/index', 'type'=>$type]),'active' => $controller == 'signup' && $item == 'index'],
                    \Yii::$app->user->identity==NULL?
                    ['label' => 'Login', 'icon' => 'log-in', 'url' => Url::to(['/login/login', 'type'=>$type]),'active' => $controller == 'login' && $item == 'login']:"",
                    \Yii::$app->user->identity!=NULL?
                    ['label' => 'Logout', 'icon' => 'log-out', 'url' => Url::to(['/login/logout', 'type'=>$type])]:"",
                    \Yii::$app->user->identity!=NULL?
                    ['label' => 'Profile/Dashboard', 'icon' => 'user', 'url' => Url::to(['/login/profile', 'type'=>$type]),'active' => $controller == 'login' && $item == 'profile']:"",
                ],
                ]);        
                ?>
            </div>
            <div class="col-sm-8" style="margin-left:5%;">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


