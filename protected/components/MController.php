<?php
class MController extends CController
{
    //public $layoutPath;
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//../modules/admin/views/layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    public $title; 
    
    public $button = array();
    
    public $saveButton = false;
    
    public function init()
    {
        $path = Yii::getPathOfAlias('application.modules.admin.assets');
        $pathTinyMCE = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.admin.assets.js.tinymce'), true, -1, YII_DEBUG);
        Yii::app()->bootstrap->register();
        Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
        $this->widget('application.extensions.fancybox.EFancyBox', array(
            'target'=>'a[rel=gallery], a[class=lightbox], .lightbox',
            'config'=>array(),
            )
        );

        $as = Yii::app()->clientScript;
        $as->registerCssFile(
            Yii::app()->assetManager->publish($path.'/css/style.css')
        );
        $as->registerScriptFile(
            Yii::app()->assetManager->publish($path.'/js/main.js')
        );

        $as->registerScriptFile($pathTinyMCE.'/tinymce.dev.js');

        $as->registerScript('tinymce', "
            tinymce.init({
                selector: '.tiny-mce',
                language: 'ru',
                plugins: 'image link table code upload charmap',
                image_advtab: true,
                image_description: false,
                image_dimensions: true
             });
        ");
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',  // Запредить все действия во всех контроллерах
                'users'=>array('*'),
            ),
        );
    }
}