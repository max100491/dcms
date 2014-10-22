<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_img')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_img),array('view','id'=>$data->id_img)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model_id')); ?>:</b>
	<?php echo CHtml::encode($data->model_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_id')); ?>:</b>
	<?php echo CHtml::encode($data->fk_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_img')); ?>:</b>
	<?php echo CHtml::encode($data->name_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt_img')); ?>:</b>
	<?php echo CHtml::encode($data->alt_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort_img')); ?>:</b>
	<?php echo CHtml::encode($data->sort_img); ?>
	<br />


</div>