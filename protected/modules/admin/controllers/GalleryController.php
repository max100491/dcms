<?php

class GalleryController extends MController
{
    
    public function actions()
    {
    	return array(
    		'delete'=>array(
    			'class'=>'DeleteAction',
    			'modelClass'=>'Gallery'
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
				'actions'=>array('admin','delete', 'create','update', 'move'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate()
	{
        if (Yii::app()->request->isAjaxRequest){
            
            $model=new Gallery;
            if(isset($_POST['Gallery']))
            {
                $model->attributes=$_POST['Gallery'];
                if($model->save()){
                    $node = new GalleryTree;
                    $root = GalleryTree::model()->findByPk($_POST['id']);
                    if($node->appendTo($root)){
                        echo 'Success';
                    }
                }
            }

            $this->renderPartial('modal_create', array('model'=>$model));

        }

        else
            throw new CHttpException(400, 'Некоректный запрос');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Gallery']))
		{
			$model->attributes=$_POST['Gallery'];
			if($model->save()){

			}
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

		$model=new Gallery('search');
		$model->unsetAttributes();
		if(isset($_GET['Gallery']))
			$model->attributes=$_GET['Gallery'];
		
		$criteria=new CDbCriteria;
		$criteria->order='t.lft';
		$tree=GalleryTree::model()->findAll($criteria);
		
		$this->render('admin',array(
			'model'=>$model,
			'tree'=>$tree,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Gallery::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionMove()
    {
        if ( !Yii::app()->request->isPostRequest ) {
            throw new CHttpException(404, 'The POST request required');
        }

        $sourceNode = GalleryTree::model()->findByPk($_POST['sourceNode']);
        $targetNode = GalleryTree::model()->findByPk($_POST['targetNode']);

        if ( !$sourceNode || !$targetNode ) {
            throw new CHttpException(404, 'Some tree node not found');
        }

        switch ( $_POST['action'] ) {

            case 'after':
                $sourceNode->moveAfter($targetNode);
                break;

            case 'before':
                $sourceNode->moveBefore($targetNode);
                break;

            case 'over':
                $sourceNode->moveAsLast($targetNode);
                break;
        }
    }
}
