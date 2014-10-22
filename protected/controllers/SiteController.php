<?php
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
	   $model = Items::model()->findByAttributes(array('type_item'=>6));
	   if($model){
	   		$meta = $model->pages[0]->meta;
	   		if(isset($meta)){
	   			$this->title = ($meta->title_meta != '') ? $meta->title_meta : $model->pages[0]->name_page ;
	   			$metatag = Yii::app()->getClientScript();
	   			$desc = ($meta->desc_meta != '') ? $meta->desc_meta : '' ;
	   			$key = ($meta->kay_meta != '') ? $meta->kay_meta : '' ;
	   			$metatag->registerMetaTag($desc, 'description');
	   			$metatag->registerMetaTag($key, 'keywords');
	   		}else{
	   			$this->title = 'Главная страница';
	   		}
			$this->render('index', array('model'=>$model));		   	
	   }else{
	   		throw new CHttpException(404, 'Страница не найдена.');
	   }
       
	}

    /**
     * action для работы категорий
     */
    public function actionCategory()
    {
        $id = $_GET['id'];
        $post = Post::model()->findByAttributes(array('cat_post'=>$id));
        
         Yii::app()->params['title'] = $post->title_post;
        
        $this->render('category', array('post' => $post));
    } 


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
}