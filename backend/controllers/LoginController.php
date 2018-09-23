<?php

namespace backend\controllers;

use Yii;
use app\models\Login;
use app\models\Signup;
use app\models\LoginForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LoginController implements the CRUD actions for Login model.
 */
class LoginController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Login models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Login::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Login model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


        public function actionProfile()
    {
            $role=\Yii::$app->user->identity->Role;
            $dataProvider = new ActiveDataProvider([
            'query' => Signup::find(),
            ]);

            if ($role==0){
                return $this->render('//signup/view', [
                'model' => Signup::findById(\Yii::$app->user->identity->signup_id),
                'model_login' => Login::findByUsername(\Yii::$app->user->identity->username),
                'show_buttons'=> TRUE,
                'dataProvider' => $dataProvider,

            ]);

            }
            else{
                return $this->render('//signup/view_admin', [
                    'model' => Signup::findById(\Yii::$app->user->identity->signup_id),
                    'model_login' => Login::findByUsername(\Yii::$app->user->identity->username),
                    'show_buttons'=> TRUE,
                    'dataProvider' => $dataProvider,

                ]);

            }

    }

    /**
     * Creates a new Login model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Login();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionLogin()
    {
        $model = new LoginForm();
         $dataProvider = new ActiveDataProvider([
            'query' => Signup::find(),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['login/profile']);
            // $logged_in_user = Login::findByUsername($model->username);
            // // $role=Login::findRoleByUsername($model->username);
            // $signup_id = $logged_in_user->signup_id;
            // $user=Signup::findById($signup_id);

            // // return $this->redirect(['//signup/view', 'id' => $user->id]);

            // $role=\Yii::$app->user->identity->Role;
            // if ($role==0){
            //     return $this->render('//signup/view', [
            //     'model' => $user,
            //     'model_login' => $logged_in_user,
            //     'show_buttons'=> TRUE,
            //     'dataProvider' => $dataProvider,

            // ]);

            // }
            // else{
            //     return $this->render('//signup/view_admin', [
            //         'model' => $user,
            //         'model_login' => $logged_in_user,
            //         'show_buttons'=> TRUE,
            //         'dataProvider' => $dataProvider,

            //     ]);

            // }

        }
        else{
            return $this->render('login', [
                'model' => $model,
            ]);
            print_r($model->getErrors());
            die();
        }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }


    /**
     * Updates an existing Login model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   

        $model = $this->findModel($id);

        $signup_id = $model->signup_id;
        $user=Signup::findById($signup_id);
        $this->redirect(['signup/update','id'=>$signup_id]);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //             return $this->render('//signup/view', [
        //     'model' => $user,
        //     'model_login' => $model,
        //     'show_buttons' => TRUE,
        // ]);
        // }



        // return $this->render('//signup/update', [
        //     'model' => $user,
        //     'model_login' => $model,
        // ]);
    }

    /**
     * Deletes an existing Login model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['//signup/update']);
    }

    public function actionLogout()
    {
        
        Yii::$app->user->logout();

        return $this->redirect(['//signup/index']);
    }
    /**
     * Finds the Login model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Login the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)

    {

        // print("hi");
        // die();
        $model = Login::find()->where(['signup_id' => $id])->one();
        if ($model) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
