<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
// use common\models\LoginForm;

// $serviceAccount = ServiceAccount::fromJsonFile('../../test-e3a78-45ae86cc1897.json');
// $firebase = (new Factory)
//     ->withServiceAccount($serviceAccount)
//     ->withDatabaseUri('https://test-e3a78.firebaseio.com/')
//     ->create();

// $database = $firebase->getDatabase();

// $newPost = $database
//     ->getReference('blog/posts')
//     ->push([
//         'title' => 'Post title',
//         'body' => 'Post body'
//     ]);


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        echo '11';
        die();
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    // public function actionLogin()
    // {
    //     if (!Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->goBack();
    //     } else {
    //         $model->password = '';

    //         return $this->render('login', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Logout action.
     *
     * @return string
     */
    // public function actionLogout()
    // {
    //     Yii::$app->user->logout();

    //     return $this->goHome();
    // }
}
