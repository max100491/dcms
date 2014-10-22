<?php
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	$model->id_gallery=>array('view','id'=>$model->id_gallery),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-file icon-white" title="Создать"></i>','url'=>array('create')),
	array('label'=>'<i class="icon-th-list icon-white" title="К списку"></i>','url'=>array('admin')),
);
$this->title = 'Редактировать'

?>
<?php echo $this->renderPartial('_form',array('model'=>$model, 'upload'=>$upload)); ?>