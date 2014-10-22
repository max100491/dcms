<?php
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	$model->id_gallery,
);

$this->menu=array(
	array('label'=>'List Gallery','url'=>array('index')),
	array('label'=>'Create Gallery','url'=>array('create')),
	array('label'=>'Update Gallery','url'=>array('update','id'=>$model->id_gallery)),
	array('label'=>'Delete Gallery','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_gallery),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gallery','url'=>array('admin')),
);
?>

<h1>View Gallery #<?php echo $model->id_gallery; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_gallery',
		'name_gallery',
		'folder_gallery',
		'min_resize',
		'type_resize',
	),
)); ?>
