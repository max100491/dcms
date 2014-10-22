<?php
$this->breadcrumbs=array(
	'Metadatas',
);

$this->menu=array(
	array('label'=>'Create Metadata','url'=>array('create')),
	array('label'=>'Manage Metadata','url'=>array('admin')),
);
?>

<h1>Metadatas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
