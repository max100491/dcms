<?php
class ModulesController extends MController
{
    public $pathFileConfog;

    public function actions()
    {
        return array(
            'delete'=>array(
                'class'=>'DeleteAction',
                'modelClass'=>'InstallModules'
            )
        );
    }

    public function init()
    {
        $this->pathFileConfog = Yii::getPathOfAlias('application.config.main').'.php';
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
				'actions'=>array('index', 'admin', 'dellmodule', 'install', 'verify'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionIndex()
    {
        $modules = Yii::app()->modules;
        $this->render('index', array('modules'=>$modules));
    }

    public function actionAdmin()
    {
        $this->title = 'Установка / Удаление';
        $model=new InstallModules('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['InstallModules']))
            $model->attributes=$_GET['InstallModules'];

        $this->render('admin', array('model'=>$model));
    }

    public function actionVerify()
    {
        $folder =  $_POST['folder'];
        if(isset($folder)){
            $pant = Yii::getPathOfAlias('application.modules').'/';
            $ftp = Yii::app()->ftp;
            if(@mkdir($pant.$folder)){
                $txt = "Папка $folder успешно создана<br>";
            }else{
                $txt = "Папка $folder не может быть создана. Возможно она уже существует или нет прав для записи<br>";
            }
            $ftp->getFilesFolder($ftp->listFiles('/dcms_modules/'.$folder), $folder);
            if($this->updateConfog($folder, true))
            {
                $txt .= 'Файл конфигурации успешно изменен.';
            }
            echo "
                $('#updatesuccess').html('$txt');
                document.location = '". Yii::app()->createUrl("/$folder/install") ."';
            ";
        }
    }

    // Изменить файл конфигурации
    public function updateConfog($module, $fl)
    {
        $file = file_get_contents($this->pathFileConfog);
        if($fl === false){
            $file = str_replace("        '".$module."',\n", '', $file);
        }
        if($fl === true){
            $file = str_replace("        '".$module."',\n", '', $file);
            file_put_contents($this->pathFileConfog, $file);
            // Не трогать эту функцию!!!
            $file = str_replace("'admin',\n", "'admin',\n        '$module',\n", $file);
        }
        return file_put_contents($this->pathFileConfog, $file);
    }
}
