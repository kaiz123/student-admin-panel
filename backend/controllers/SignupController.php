<?php

namespace backend\controllers;

use Yii;
use app\models\Signup;
use app\models\Login;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\City;
use app\models\Location;
use yii\helpers\Json;
use yii\web\UploadedFile;
/**
 * SignupController implements the CRUD actions for Signup model.
 */
class SignupController extends Controller
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
     * Lists all Signup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Signup::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Signup model.
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

    public function actionCity() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $state_id = $parents[0];
            $out = City::getCityList($state_id); 
           
            // the getSubCatList function will query the database based on the
            // state_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
            echo Json::encode(['output'=>$out, 'selected'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
}

    /**
     * Creates a new Signup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Signup();
        $model_login = new Login();
        $dataProvider = new ActiveDataProvider([
            'query' => Signup::find(),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model_login->load(Yii::$app->request->post())) {
            $model->Profile_Pic = UploadedFile::getInstance($model, 'Profile_Pic');
            //print_r($model);
           // print_r($model_login);
            //die();
            if($model->save()){
                
                $model_login->updated_at= date("Y/m/d");
                $model_login->created_at= date("Y/m/d");
                $model_login->signup_id=$model->id;
                $model_login->generateAuthKey();
                $model_login->setPassword($model_login->password);
                $model_login->generatePasswordResetToken();
                // $model_login->validatePassword($model_login->password);
                $model->upload($model->id);

                if(!$model_login->save()){
                    print_r($model_login->getErrors());
                    die();
                }
                

            }else{
                print_r($model->getErrors());
                die();
            }

            return $this->redirect(['//login/login']);

        }

        // if ($model->load(Yii::$app->request->post()) && $model_login->load(Yii::$app->request->post())) {
        //     // return $this->redirect(['view', 'id' => $model->id]);
        //     print ("hey");
        // }

        return $this->render('create', [
            'model' => $model,
            'model_login' => $model_login,
        ]);
    }


    public function actionLocation() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $ids = $_POST['depdrop_parents'];
        $state_id = empty($ids[0]) ? null : $ids[0];
        $city_id = empty($ids[1]) ? null : $ids[1];
        if ($state_id != null) {
           $data = Location::getLocationsList($state_id, $city_id);
            /**
             * the getProdList function will query the database based on the
             * cat_id and sub_cat_id and return an array like below:
             *  [
             *      'out'=>[
             *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
             *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
             *       ],
             *       'selected'=>'<prod-id-1>'
             *  ]
             */
           echo Json::encode(['output'=>$data, 'selected'=>'1']);
           return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Updates an existing Signup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_login = $this->findLoginModel($id);
        

        if ($model->load(Yii::$app->request->post()) && $model_login->load(Yii::$app->request->post())) {

            $model->Profile_Pic = UploadedFile::getInstance($model, 'Profile_Pic');

            //print_r($model);
           // print_r($model_login);
            //die();

            if($model->save()){
                $model_login->signup_id=$model->id;
                $model_login->generateAuthKey();
                $model_login->setPassword($model_login->password);
                $model_login->generatePasswordResetToken();
                $model_login->validatePassword($model_login->password);
                $model_login->save();
                if($model->Profile_Pic){
                    $model->upload($id);
                }
            }else{
                print_r($model->getErrors());
                die();
            }
            // print("inside");
            // die();
            return $this->render('view', [
            'model' => $model,
            'model_login' => $model_login,
            'show_buttons' => TRUE,
        ]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_login' => $model_login,
        ]);
    }

    /**
     * Deletes an existing Signup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Signup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Signup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Signup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findLoginModel($id)
    {   
        $model_login = Login::find()->where(['signup_id' => $id])->one();
        if ($model_login) {
            // $model_login = new Login();
 
            return $model_login;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
