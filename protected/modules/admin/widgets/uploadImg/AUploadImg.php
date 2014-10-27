<?php

Yii::import('ext.portlet.XPortlet');
/**
* Виджет для ajax загрузки изображений в админке
*/
class AUploadImg extends CWidget
{
    public $model;
    public $action = '/admin/images/upload';
    public $fk_id;
    public $model_id;
    public $folder = null;
    public $allowedExtensions = array("jpg","jpeg","gif");
    public $sizeLimit;
    public $minSizeLimit;
    public $resize = array();
    public $type_resize = array('resize'=>'Маштабирование изображения', 'adaptive'=>'Обрезка изображения');

    public function init()
    {
        $assets = dirname(__FILE__).'/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);
        Yii::app()->clientScript->registerCssFile($baseUrl . '/style.css');
        Yii::app()->clientScript->registerScriptFile($baseUrl . '/main.js');

        if (!$this->model->isNewRecord) {
            
            if ($this->model==null)
                throw new CHttpException(400, 'Нет модели');
                
            $this->sizeLimit = (isset($this->sizeLimit)) ? $this->sizeLimit : 10*1024*1024;
            $this->minSizeLimit = (isset($this->minSizeLimit)) ? $this->minSizeLimit : 1024;
            $this->fk_id = $this->model->primaryKey;
            $this->model_id = Models::model()->findByAttributes(array('type_model'=>get_class($this->model)))->primaryKey;
            $this->resize = (!empty($this->resize)) ? $this->resize : $this->model->resizeImage();

            if (is_null($this->folder)) {
                if (get_class($this->model) == 'Gallery')
                    $this->folder = $this->model->folder_gallery;
                else
                    $this->folder = $this->model->folderImages;
            }

            $this->renderContent();

        }else{
            echo '<p>Для загрузки изображений нажмите кнопку сохранить</p>';
        }
    }

    public function renderContent()
    {
        $params['allowedExtensions'] = $this->allowedExtensions;
        $params['folder'] = $this->folder;
        $params['sizeLimit'] = $this->sizeLimit;
        $params['model_id'] = $this->model_id;
        $params['fk_id'] = $this->fk_id;

        $images = Yii::app()->db->createCommand()
            ->select('name_img, id_img, is_root, alt_img')
            ->from('cf_images')
            ->where('model_id=:model_id AND fk_id=:fk_id', array(':model_id'=>$this->model_id, ':fk_id'=>$this->fk_id))
            ->queryAll();

        $this->render('view', array(
            'params'=>$params,
            'images'=>$images,
        ));
    }
}

?>