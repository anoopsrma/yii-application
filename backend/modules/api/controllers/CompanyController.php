<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\mongodb\Query;
use yii\data\ActiveDataProvider;
use backend\modules\api\models\Company;

class CompanyController extends \yii\rest\Controller
{
	public $enableCsrfValidation = false;
	protected $query = null;

	public function beforeAction($action)
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$this->query = new Query();
		return parent::beforeAction($action);
	}

    public function actionIndex()
    {
    	if (count($companies = $this->query->from('company')->all()) === 0) {
    		return $this->asJson(['error' => 'Company Collection is Empty']);
    	}
        return ['data' => $companies];
    }

    public function actionStore()
    {
    	$request = Yii::$app->request->post();
    	$collection = Yii::$app->mongodb->getCollection('company');
    	try {
    		$collection->insert([
	    		"name" => $request['name'],
				"description" => $request['description'],
				"employee" => $request['employee'],
				"status" => $request['status']
	    	]);
	    	return $this->asJson(['success' => 'Company Successfully Added']);
    	} catch (\Exception $e) {
    		Yii::$app->response->statusCode = 422;
    		return [
    		        'error' => 'Something Went Wrong',
    		    ];
    	}
    }

    public function actionShow($id)
    {
    	if (count($company = $this->query->from('company')->where(['_id' => $id])->one()) === 0) {
    		return $this->asJson(['error' => 'Company Collection is Empty']);
    	}
        return ['data' => $company];
    }

    public function actionUpdate($id)
    {
    	if (count($company = $this->query->from('company')->where(['_id' => $id])->one()) === 0) {
    		return $this->asJson(['error' => 'Company Not found']);
    	}
    	$request = Yii::$app->request->post();
    	try {
			$collection = Yii::$app->mongodb->getCollection('company');
		  	$arrUpdate = [
		        'name' => $request['name'],
		        'description' => $request['description'],
		        'employee' => $request['employee'],
		        'status' => $request['status']
		    ];
			$collection->update(['_id' => $id], $arrUpdate);
			return $this->asJson(['success' => 'Company Successfully Added']);
    	} catch (\Exception $e) {
    		Yii::$app->response->statusCode = 422;
    		return [
		        'error' => 'Something Went Wrong',
    		];
    	}
    }

    public function actionDelete($id)
    {
    	try {
			$collection = Yii::$app->mongodb->getCollection('company');
    		$collection->remove(['_id' => $id]);
    	} catch (\Exception $e) {
    		Yii::$app->response->statusCode = 422;
    		return [
		        'error' => 'Something Went Wrong',
    		];
    	}
    }
}
