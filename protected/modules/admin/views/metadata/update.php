<?php
$this->breadcrumbs=array(
	'Metadatas'=>array('index'),
	$model->id_meta=>array('view','id'=>$model->id_meta),
	'Update',
);

$this->menu=array(
	array('label'=>'List Metadata','url'=>array('index')),
	array('label'=>'Create Metadata','url'=>array('create')),
	array('label'=>'View Metadata','url'=>array('view','id'=>$model->id_meta)),
	array('label'=>'Manage Metadata','url'=>array('admin')),
);
?>

<h1>Update Metadata <?php echo $model->id_meta; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>