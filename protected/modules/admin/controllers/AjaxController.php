<?php
class AjaxController extends MController
{
    public function actionDeletegridimg()
    {
        print_r($_POST);
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
    
}
?>