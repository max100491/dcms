<?php
class NewsController extends Controller
{   
    public function actionIndex($id)
    {
        $model = Pages::model()->findByPk($id);
        if($model){
            $this->render('index', array('page'=>$model));
        }else{
            throw new CHttpException(404,'Страница не найдена.');
        }
    }
    
    public function actionNewslist($id)
    {
        $model = Items::model()->findByPk($id);
        $parent = Items::model()->findAllByAttributes(array('parent_id'=>$id));
        if($model)
        {
            if(empty($parent))
            {
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
            }
            $this->render('newslist', array('model'=>$model, 'dataProvider'=>$dataProvider, 'parent'=>$parent));
        }else{
            throw new CHttpException(404,'Страница не найдена.');
        }
        
    }

}
