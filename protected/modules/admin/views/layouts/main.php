<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->title; ?></title>
    </head>
    <body>
        <div class="container" style="margin-top: 50px;">
            <?php $this->widget('bootstrap.widgets.TbNavbar', array(
                //'type'=>'', // null or 'inverse'
                'brand'=>false,
                'collapse'=>true, // requires bootstrap-responsive.css
                'items'=>array(
                    array(
                        'class'=>'bootstrap.widgets.TbMenu',
                        'items'=>array(
                            array('label'=>'DC', 'url'=>array('/admin')),
                            array('label'=>'Страницы', 'url'=>array('/admin/pages/admin')),
                            array('label'=>'Меню', 'url'=>'#', 'items'=>array(
                                array('label'=>'Все меню', 'url'=>array('/admin/menu/admin')),
                                array('label'=>'Создать', 'url'=>array('/admin/menu/create')),
                                '---',
                                array('label'=>'ПУНКТЫ МЕНЮ'),
                                array('label'=>'Все пункты', 'url'=>array('/admin/items/admin')),
                                array('label'=>'Создать', 'url'=>array('/admin/items/create')),
                            )),
                            array('label'=>'Галереи / Изображения', 'url'=>array('/admin/gallery/admin')),
                            array('label'=>'Модули', 'url'=>array('/admin/modules/index'), 'items'=>array(
                                array('label'=>'Операции'),
                                array('label'=>'Установленные', 'url'=>array('/admin/modules/index')),
                                array('label'=>'Установка / Удаление', 'url'=>array('/admin/modules/admin')),
                                '---',
                                array('label'=>'Установленные'),
                            )),
                            array('label'=>'Настройки', 'url'=>array('/admin/siteOptions/admin')),
                            array('label'=>'Выход', 'url'=>array('/autch/logout')),
                        ),
                    ),
                ),
            )); ?>
            <div class="btn-group pull-right">
                <?php foreach($this->menu as $btn){
                    @$class = $btn['htmlOptions']['class'];
                    @$id = $btn['htmlOptions']['id'];
                    echo CHtml::link($btn['label'], $btn['url'], array('class'=>'btn btn-info '.$class, 'id'=>$id));
                }?>
            </div>
            <h4><?php echo $this->title?></h4>
            <div>
                <?php echo $content; ?>
            </div>
        </div>
        <div id="loader" class="loader">
            <div style="margin-left: 80px;">
                <p class="alert-message"></p>
            </div>
        </div>
    </body>
</html>