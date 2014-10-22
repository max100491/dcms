<?php Yii::import('ext.portlet.XPortlet');

/**
 *   <?php $this->widget('GetPages', array(
 *       'id'=>5,
 *       'limit'=>'4, 5',
 *   ));?>
 */

class GetPages extends XPortlet
{
    public $id;
    public $limit = 4;
    public $view = 'pages';
    
  public function renderContent()
	{
     $model = Items::model()->findByPk($this->id);
     if($model){
          $model = $model->pages(array(
              'limit'=>$this->limit,
          ));
         $this->render($this->view, array('model'=>$model));
     }else{
         throw new CHttpException(404,'Категория не найдена');
     }
	}
}
?>