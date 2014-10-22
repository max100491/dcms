<?php

class ItemsController extends MController
{
	public function actions()
    {
    	return array(
    		'delete'=>array(
    			'class'=>'DeleteAction',
    			'modelClass'=>'Items'
    		)
    	);
    }

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'create','update', 'dellimage'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Items;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
            $model->meta = $model->saveMeta();
            $model->menu = $model->menu_id;
			if($model->save())
				$this->redirect(array('update','id'=>$model->id_item));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
            $model->meta = $model->saveMeta();
            $model->menu = $model->menu_id;
			if($model->save())
				$this->redirect(array('update','id'=>$model->id_item));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Items('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Items']))
			$model->attributes=$_GET['Items'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDellimage()
	{
		$id = $_GET['id_item'];
		if(isset($id)){
			$model = $this->loadModel($id);
			if(!empty($model->thumbroot)){
				if(file_exists($model->path.$model->thumbroot->name_img)){
                    unlink($model->path.$model->thumbroot->name_img);
                }
                if(file_exists($model->path.'admin/'.$model->thumbroot->name_img)){
                    unlink($model->path.'admin/'.$model->thumbroot->name_img);
                }
                if(file_exists($model->path.'thumb/'.$model->thumbroot->name_img)){
                    unlink($model->path.'thumb/'.$model->thumbroot->name_img);
                }
                $model->thumbroot->delete();
			}
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Items::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
