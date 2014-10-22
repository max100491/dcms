<?php
$this->breadcrumbs=array(
	'Site Options'=>array('index'),
	$model->id_option=>array('view','id'=>$model->id_option),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-file icon-white" title="Создать"></i>','url'=>array('create')),
	array('label'=>'<i class="icon-th-list icon-white" title="К списку"></i>','url'=>array('admin')),
);

$this->title = 'Редактировать настройки';

?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>