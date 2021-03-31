<?php

namespace app\modules\photogallery\modules\admin\controllers;

use Yii;
use app\modules\photogallery\models\CategoryDeleteForm;
use app\modules\photogallery\models\Category;
use app\modules\photogallery\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->username == "demo") {
            return $this->goHome();
        }

        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->username == "demo") {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->username == "demo") {
            return $this->goHome();
        }

        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->count = 0;

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);  
            } 
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->username == "demo") {
            return $this->goHome();
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->username == "demo") {
            return $this->goHome();
        }

        $category = $this->findModel($id);
        $model = new CategoryDeleteForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->action === "move" && $model->category === "") {
                Yii::$app->getSession()->setFlash('error','Category missed!');
                return $this->redirect(['delete','id' => $id]);
            } else{
                echo $model->action."<br />";
                echo $model->category;
            }
        }

        return $this->render('delete', [
            'model' => $model,
            'category' => $category,
        ]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->username == "demo") {
            return $this->goHome();
        }
        
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
