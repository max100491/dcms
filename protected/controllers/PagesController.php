<?php

class PagesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';
    
    public function actionIndex($id)
    {
        $model = Items::model()->findByPk($id);
        if($model)
        {
            $model = $model->pages(array('order'=>'sort_page DESC', 'limit'=>1));
            $meta = $model[0]->meta;
            if(isset($meta)){
                $this->title = ($meta->title_meta != '') ? $meta->title_meta : $model[0]->name_page ;
                $metatag = Yii::app()->getClientScript();
                $desc = ($meta->desc_meta != '') ? $metatag->registerMetaTag($meta->desc_meta, 'description') : '' ;
                $key = ($meta->kay_meta != '') ? $metatag->registerMetaTag($meta->kay_meta, 'keywords') : '' ;
            }else{
                $this->title = $model[0]->name_page;
            }
            $this->breadcrumbs = array($model[0]->name_page);
            $this->render('index', array('model'=>$model));
        }else{
            throw new CHttpException(404,'Страница не найдена.');
        }
    }
    
    public function actionPages($id)
    {
        $model = Items::model()->findByPk($id);
        if($model)
        {
            $meta = $model->meta;
            if($meta){
                $this->title = ($meta->title_meta != '') ? $meta->title_meta : $model->name_item ;
                $metatag = Yii::app()->getClientScript();
                $desc = ($meta->desc_meta != '') ? $metatag->registerMetaTag($meta->desc_meta, 'description') : '' ;
                $key = ($meta->kay_meta != '') ? $metatag->registerMetaTag($meta->kay_meta, 'keywords') : '' ;
            }else{
                $this->title = $model->name_item;
            }
            $dataProvider = new CActiveDataProvider('Pages', array(
                'criteria'=>array(
                    'with'=>array('items'),
                    'order'=>'sort_page ASC',
                    'condition'=>"t.status_id = 2 AND items.id_item = $id",
                    'together'=>true,
                ),
                'pagination'=>array(
                    'pageSize'=>15,
                )
            ));
            $this->breadcrumbs = array($model->name_item);

            $this->render('pages', array('model'=>$model, 'dataProvider'=>$dataProvider));
        }else{
            throw new CHttpException(404,'Страница не найдена.');
        }
    }
    
    public function actionArticles($id)
    {
        $model = Pages::model()->findByPk($id);
        if($model){
            if($model->meta){
                $this->title = (isset($model->meta->title_meta)  && $model->meta->title_meta != '') ? $model->meta->title_meta : $model->name_item ;
                $metatag = Yii::app()->getClientScript();
                $desc = (isset($model->meta->desc_meta) && $model->meta->desc_meta != '') ? $metatag->registerMetaTag($model->meta->desc_meta, 'description') : '' ;
                $key = (isset($model->meta->kay_meta) && $model->meta->kay_meta != '') ? $metatag->registerMetaTag($model->meta->kay_meta, 'keywords') : '' ;
            }else{
                $this->title = $model->name_page;
            }

            $this->breadcrumbs = array($model->name_page);

            $this->render('articles', array('page'=>$model));
        }else{
            throw new CHttpException(404,'Страница не найдена.');
        }
    }

}
