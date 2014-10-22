<?php

class ImagesController extends MController
{
    /**
     * @var string.
     */
    public $insertNull = 'N$';
    public $idCheckBoxColumn = 'checkboxlist';
    public $idButtonUpdateAll = 'updateall';
    public $idLinkDeleteAll = 'deleteallelements';

    public function actions()
    {
        return array(
            'delete'=>array(
                'class'=>'DeleteAction',
                'modelClass'=>'Images'
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
				'actions'=>array('admin','delete', 'create','update'),
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
		$model=new Images;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Images']))
		{
			$model->attributes=$_POST['Images'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id_img));
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

		if(isset($_POST['Images']))
		{
			$model->attributes=$_POST['Images'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id_img));
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
		$model=new Images('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Images']))
			$model->attributes=$_GET['Images'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Images::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='images-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionUpload()
    {
        $model=new UploadImages;
		if(isset($_POST['UploadImages']))
		{
            $model->images = CUploadedFile::getInstances($model, 'images');
            $path = Yii::getPathOfAlias('webroot.upload.images').'/';
            foreach($model->images as $kay=>$image){
                $model->image = $image;
                $fileType = explode('.', $image->name);
                $filename = uniqid();
                $filename = $filename.'.'.$fileType[1];
                $model->attributes = $_POST['UploadImages'];
                $model->name_img = $filename;
                $model->alt_img = $fileType[0];
                if($model->save()){
                    $image->saveAs($path.$filename);
                }
                $model->id_img = false;
                $model->isNewRecord = true;
            }
		}
        $this->render('upload', array(
            'model'=>$model,
        ));
    }
    
    /**
     * Массовое удаление элементов.
     */
    
    public function actionDeletechecked()
    {
     if (isset($_POST[$this->idCheckBoxColumn]))
      { 
        foreach ($_POST[$this->idCheckBoxColumn] as $id)
        $this->loadModel($id)->delete();
        echo 'Выбранные элементы успешно удалены. Подождите пока журнал обновится.';
        return;
    }
    echo 'Элементы не выбраны.';
    return;
       }
    
    /**
     * @return array возвращает настройки ajax под id элемента.
     */
    
     public function ajaxQueryById($id,$switch = 'link')
    {
        if ($id == null || !is_string($id)) return;
        if ($switch == 'submit')
        {   $data = '"button=OK&" + $(\'#categories-form, input[name="'.$this->idCheckBoxColumn.'[]"]:checked\').serialize()';
            $id = '#categories-form #'.$id;
        }   else 
        {   $data = '$(\'input[name="[]"]:checked\').serialize()';
            $id = '#'.$id;
        }
        $array = array(
    'type'=>'post',
    'beforeSend'=>'function(){'.self::blockUnButton($id,'true').'}',
    'error'=>'function(xhr, status){alert(\'Ошибка отправки.\'); '.self::blockUnButton($id).'}',
    'data'=>'js: '.$data,
    'success'=>'function(data){$(\'#categories-grid\').yiiGridView(\'update\'); alert(data); '.self::blockUnButton($id).'}');
    return $array;   
    }
    
    /**
     * @return string генерирует код блокировки и разблокировки кнопок.
     */
    
    public static function blockUnButton($id,$block = 'false')
    {
     return ' $(\''.$id.'\').prop(\'disabled\','.$block.');';  
    }
    
    /**
     * @return boolean возвращает true если замена прошла успешно.
     */
    
    protected function updateAll($pk,$attributes)
    {
    foreach ($attributes as $key=>$value)
    if ($value == $this->insertNull) $array[$key] = null; 
    elseif ($value != null) $array[$key] = $value; 
    if ($array == null) return false;
    Categories::model()->updateByPk($pk,$array);
    unset ($array); unset($pk);
    return true;
    }
    
}
