<?php
$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->id_img,
);

$this->menu=array(
	array('label'=>'List Images','url'=>array('index')),
	array('label'=>'Create Images','url'=>array('create')),
	array('label'=>'Update Images','url'=>array('update','id'=>$model->id_img)),
	array('label'=>'Delete Images','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_img),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Images','url'=>array('admin')),
);
?>

<h1>View Images #<?php echo $model->id_img; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_img',
		'model_id',
		'fk_id',
		'name_img',
		'alt_img',
		'sort_img',
	),
)); ?>
