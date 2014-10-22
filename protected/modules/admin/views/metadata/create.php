<?php
$this->breadcrumbs=array(
	'Metadatas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Metadata','url'=>array('index')),
	array('label'=>'Manage Metadata','url'=>array('admin')),
);
?>

<h1>Create Metadata</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>