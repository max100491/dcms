<?php
$this->breadcrumbs=array(
	'Metadatas'=>array('index'),
	$model->id_meta,
);

$this->menu=array(
	array('label'=>'List Metadata','url'=>array('index')),
	array('label'=>'Create Metadata','url'=>array('create')),
	array('label'=>'Update Metadata','url'=>array('update','id'=>$model->id_meta)),
	array('label'=>'Delete Metadata','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_meta),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Metadata','url'=>array('admin')),
);
?>

<h1>View Metadata #<?php echo $model->id_meta; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_meta',
		'model_id',
		'fk_id',
		'name_meta',
		'title_meta',
		'desc_meta',
		'kay_meta',
	),
)); ?>
