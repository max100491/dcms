<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Manage',
);

$this->menu=array(
    array('label'=>'<i class="icon-fullscreen icon-white" title="Сортировка"></i>', 'url'=>'#block-sort', 'htmlOptions' => array('class'=>'lightbox', 'id'=>'inline')),
    array('label'=>'<i class="icon-file icon-white" title="Создать"></i>','url'=>array('create')),
);
$this->title = 'Пункты меню';

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_item'=>array(
            'name'=>'id_item',
            'value'=>'$data->id_item',
            'htmlOptions'=>array(
                'width'=>50,
            ),
        ),
		'name_item'=>array(
            'name'=>'name_item',
            'type'=>'html',
            'value'=>'CHtml::link($data->name_item, array("/admin/items/update", "id"=>$data->id_item))',
        ),
		'type_item',
		'status_id'=>array(
            'name'=>'status_id',
            'value'=>'$data->status->name_status',
            'filter'=>Status::model()->getList(),
            'htmlOptions'=>array(
                'width'=>50,
            ),
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>

<div style="display: none;">
    <div class="block-sort" id="block-sort">
        <ul class="sort">
            <?php foreach($model->findAll(array('order'=>'sort_item ASC')) as $text):?>
                <li id="<?php echo $text->id_item?>"><?php echo CHtml::link($text->name_item, array('/admin/items/update', 'id'=>$text->id_item));?> <i class="icon-fullscreen" style="float: right;"></i></li>
            <?php endforeach;?>
        </ul>
    </div>
</div>