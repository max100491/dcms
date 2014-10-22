<?php
$this->breadcrumbs=array(
	'Menus'=>array('index'),
	$model->id_menu=>array('view','id'=>$model->id_menu),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-file icon-white" title="Создать"></i>','url'=>array('create')),
	array('label'=>'<i class="icon-th-list icon-white" title="К списку"></i>','url'=>array('admin')),
);
$this->title = 'Редактирование меню';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>