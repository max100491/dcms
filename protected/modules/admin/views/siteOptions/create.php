<?php
$this->breadcrumbs=array(
	'Site Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Все','url'=>array('admin')),
);
?>

<h1>Create SiteOptions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>