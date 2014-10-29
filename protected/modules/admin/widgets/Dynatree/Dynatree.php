<?php

class Dynatree extends CWidget
{

	public $assets;
	public $options;
	public $tree;
	public $actions;
	public $model_data;
	public $js_options = array();
	public $link_options;
	public $change_url;
	public $getParams = array();
	
	public function init()
	{
		$assets = dirname(__FILE__).'/ass';
		$this->assets = Yii::app()->assetManager->publish($assets, false, -1, YII_DEBUG);
		$ass = Yii::app()->assetManager->publish($this->controller->pathAssets, false, -1, YII_DEBUG);

		if ( !$this->tree || count($this->tree) == 0 ) {
			throw new CHttpException(404, Yii::t('r', 'The passed tree is empty'));
		}
		Yii::app()->clientScript
            ->registerCoreScript('jquery')
			->registerScriptFile($ass . '/js/jquery.cookie.js')
			->registerScriptFile($ass . '/js/plugins/ui/jquery-ui-1.9.2.custom.min.js')
			->registerScriptFile($this->assets . '/js/jquery.dynatree.min.js')
			->registerScriptFile($this->assets . '/js/jquery.dynatree.adapter.js')
            ->registerCssFile($this->assets . '/css/ui.dynatree.css')
            ->registerCssFile($this->assets . '/css/jquery.contextMenu.css');

		$this->render('dynatree');

        parent::init();
	}

}
