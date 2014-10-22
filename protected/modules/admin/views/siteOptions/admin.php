<?php
$this->breadcrumbs=array(
	'Site Options'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
);

$this->title = 'Все настройки';

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'site-options-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_option',
		'name_option',
		'value_option',
		'model_id',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
