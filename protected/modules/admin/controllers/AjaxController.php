<?php
class AjaxController extends MController
{
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('upload', 'fileRemove'),
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