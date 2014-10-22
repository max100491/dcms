<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->id_page=>array('view','id'=>$model->id_page),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-file icon-white" title="Создать"></i>','url'=>array('create')),
	array('label'=>'<i class="icon-th-list icon-white" title="К списку"></i>','url'=>array('admin')),
);
$this->title = 'Обновить запись';
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>