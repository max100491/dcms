<?php
class AjaxController extends MController
{
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('upload'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionDeletegridimg()
    {
        print_r($_GET);
    }
    
    public function actionUpdateimage()
    {
        echo 'test';
    }
    
    // Сортирует сортирует изображения
    public function actionImageSort()
    {
        foreach($_POST['idimage'] as $kay=>$id)
        {
            if(isset($id) && is_numeric($id)){
                $model = Images::model()->findByPk($id);
                $model->sort_img = $kay;
                $model->save();
            }
        }
    }
    
    
    // Удаление изображения
    public function actionDellImg()
    {
        $id = $_POST['id'];
        if(isset($id) && is_numeric($id)){
            $image = Images::model()->findByPk($id);
            $path = Yii::getPathOfAlias('webroot.upload.images').'/'.$_POST['folder'].'/';
            if(file_exists($path.$image->name_img)){
                unlink($path.$image->name_img);
            }
            if(file_exists($path.'admin/'.$image->name_img)){
                unlink($path.'admin/'.$image->name_img);
            }
            if(file_exists($path.'thumb/'.$image->name_img)){
                unlink($path.'thumb/'.$image->name_img);
            }
            $image->delete();
        }
        echo $id;
        Yii::app()->end();
    }
    
    public function actionItemSort()
    {
        $idAll = $_POST['idites'];
        foreach($idAll as $kay=>$item){
            $model = Items::model()->findByPk($item);
            $model->sort_item = $kay;
            $model->save();
        }
        echo 'ok';
        Yii::app()->end();
    }

    public function actionGetallgallery()
    {
        $gallery = Yii::app()->db->createCommand()
            ->select('name_gallery, folder_gallery, i.name_img')
            ->from('cf_gallery t')
            ->join('cf_images i', 't.id_gallery=i.fk_id and i.is_root = 1')
            ->queryAll();
        echo CJSON::encode($gallery);
    }

    public function actionUpload()
    {
        if (Yii::app()->request->isAjaxRequest) {
            
            $model = new Images;
            $model->setAttributes($_GET);
            
            Yii::import("ext.EAjaxUpload.qqFileUploader");

            $ds = DIRECTORY_SEPARATOR;

            $pathOfImage = $model->pathOriginal.$_GET['qqfile']; // путь до файла

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
            if ($model->save()) {
                
            }else{
                if (!isset($result['error']))
                    $result['error'] = $model->errors;
            }

            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $result;

        }
    }
    
}
?>