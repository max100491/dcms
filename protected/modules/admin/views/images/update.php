<?php
$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->id_img=>array('view','id'=>$model->id_img),
	'Update',
);

$this->menu=array(
	array('label'=>'List Images','url'=>array('index')),
	array('label'=>'Create Images','url'=>array('create')),
	array('label'=>'View Images','url'=>array('view','id'=>$model->id_img)),
	array('label'=>'Manage Images','url'=>array('admin')),
);
?>

<h1>Update Images <?php echo $model->id_img; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>