<?php
$this->breadcrumbs=array(
	'Menus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<i class="icon-th-list icon-white" title="К списку"></i>','url'=>array('admin')),
);
$this->title = 'Создать';
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>