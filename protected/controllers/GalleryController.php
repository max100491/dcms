<?php
class GalleryController extends Controller
{

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Gallery');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionList($id)
	{
	   $model = new Gallery;
		$dataProvider=new CActiveDataProvider('Images', array(
            'criteria'=>array(
                'condition'=>"model_id = 6 AND fk_id = $id",
                'order'=>'sort_img ASC',
            ),
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=Gallery::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
