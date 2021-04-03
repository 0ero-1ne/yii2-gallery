<?php

namespace app\modules\photogallery\modules\page\controllers;

use Yii;
use app\modules\photogallery\models\Category;
use app\modules\photogallery\models\Image;
use yii\web\Controller;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `page` module
 */
class PageController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	//Yii::$app->user->identity->username == "demo"
    	if (Yii::$app->user->isGuest) {
    		$query = Category::find()->where(['status' => 'guest'])->orderBy('title');
    	} else if (Yii::$app->user->identity->username == "demo") {
    		$query = Category::find()->where(['status' => 'guest'])->orWhere(['status' => 'user'])->orderBy('title');
    	} else if (Yii::$app->user->identity->username == "admin") {
    		$query = Category::find()->where(['status' => 'guest'])->orWhere(['status' => 'user'])->orWhere(['status' => 'admin'])->orderBy('title');
    	}
    	
    	$dataProvider = new ActiveDataProvider([
		    'query' => $query,
		    'pagination' => [
		    	'pageSize' => 1,
		    	'forcePageParam' => false,
		    	'pageSizeParam' => false,
		    ],
		]);

    	$countQuery = clone $query;
	    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 1, 'forcePageParam' => false, 'pageSizeParam' => false]);
	    $models = $query->offset($pages->offset)
	        ->limit($pages->limit)
	        ->all();
	    $amountModels = count($models);


        return $this->render('index',[
        	'dataProvider' => $dataProvider,
        	'models' => $models,
        	'pages' => $pages,
        	'amount' => $countQuery->count(),
        ]);
    }
}
