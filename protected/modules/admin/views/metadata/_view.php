<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_meta')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_meta),array('view','id'=>$data->id_meta)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model_id')); ?>:</b>
	<?php echo CHtml::encode($data->model_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fk_id')); ?>:</b>
	<?php echo CHtml::encode($data->fk_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_meta')); ?>:</b>
	<?php echo CHtml::encode($data->name_meta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_meta')); ?>:</b>
	<?php echo CHtml::encode($data->title_meta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_meta')); ?>:</b>
	<?php echo CHtml::encode($data->desc_meta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kay_meta')); ?>:</b>
	<?php echo CHtml::encode($data->kay_meta); ?>
	<br />


</div>