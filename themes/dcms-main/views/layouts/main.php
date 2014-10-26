<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->title; ?></title>
    
    <?php
        Yii::app()->clientScript->registerCssFile(
            Yii::app()->assetManager->publish(Yii::app()->theme->basePath.'/assets/style.css', false, -1, YII_DEBUG)
        );
        Yii::app()->clientScript->registerScriptFile( // плагин который поднимает уведомления http://ned.im/noty/#layouts - смотреть тут
            Yii::app()->assetManager->publish(Yii::app()->theme->basePath.'/assets/js/noty/packaged/jquery.noty.packaged.min.js')
        ); 
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(Yii::app()->theme->basePath.'/assets/js/main.js', false, -1, YII_DEBUG)
        );
	?>
  </head>
  <body>
    <div class="container">
        <?php 
        // $this->widget('bootstrap.widgets.TbNavbar', array(
        //     'type'=>'inverse', // null or 'inverse'
        //     'brand'=>false,
        //     'brandUrl'=>'#',
        //     'collapse'=>true, // requires bootstrap-responsive.css
        //     'items'=>array(
        //         array(
        //             'class'=>'bootstrap.widgets.TbMenu',
        //             'items'=>Menu::model()->getItemMenuId(1),
        //         ),
        //     ),
        // )); 
        ?>
        <?php if(SiteOptions::model()->getOptionsBul('bread')):?>
        <div style="margin-top: 60px;">
            <?php /*$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
            )); */?>
        </div>
        <?php endif;?>
        <div class="content">
            <?php echo $content; ?>
        </div>
    </div>
  </body>
</html>