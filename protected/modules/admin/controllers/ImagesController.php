<?php

class ImagesController extends MController
{    
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
				'actions'=>array('delete', 'upload', 'resize'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionDelete($id, $folder)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = Images::model()->findByPk($id);
            echo $model->folder = $folder;
            if($model->delete())
                echo 'success';
            else
                echo 'error';
        }
    }

    public function actionUpload()
    {
        if (Yii::app()->request->isAjaxRequest) {
            
            $model = new Images;
            $model->setAttributes($_GET);
            
            Yii::import("ext.EAjaxUpload.qqFileUploader");

            $ds = DIRECTORY_SEPARATOR;

            $pathOfImage = $model->originalPath.$_GET['qqfile']; // путь до файла

            $folder = 'upload'.$ds.'images'.$ds.$_GET['folder'].$ds;
            $allowedExtensions = $_GET['allowedExtensions'];
            $sizeLimit = $_GET['sizeLimit'];

            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);

            $pathInfo = pathinfo($pathOfImage); // информация о загруженном файле

            $name_img = uniqid().'.'.$pathInfo['extension'];

            $model->name_img = $name_img;
            $model->alt_img = $pathInfo['filename'];
            $model->sort_img = 0;
            $model->is_root = 0;
            $model->save();
            
            $result=CJSON::encode($result);
            echo $result;

        }
    }

    public function actionResize()
    {
        if(count($_POST) == 4){
            $size = $_POST['size'];
            $resize = $_POST['resize'];
            $filename = $_POST['file'];
            $size = explode('x', $size);
            $path = Yii::getPathOfAlias('webroot.upload.images').DIRECTORY_SEPARATOR.$_POST['folder'].DIRECTORY_SEPARATOR;
            if($resize == 'resize'){
                $thumb = Yii::app()->phpThumb->create($path.$filename);
                $thumb->resize($size[0], $size[1]);
                $thumb->save($path.'thumb'.DIRECTORY_SEPARATOR.$filename);
            }elseif($resize == 'adaptive'){
                $thumb = Yii::app()->phpThumb->create($path.$filename);
                $thumb->adaptiveResize($size[0], $size[1]);
                $thumb->save($path.'thumb'.DIRECTORY_SEPARATOR.$filename);
            }
            echo 'ok';
        }
    }

}
