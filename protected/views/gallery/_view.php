<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_gallery')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_gallery),array('view','id'=>$data->id_gallery)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_gallery')); ?>:</b>
	<?php echo CHtml::encode($data->name_gallery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('folder_gallery')); ?>:</b>
	<?php echo CHtml::encode($data->folder_gallery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_resize')); ?>:</b>
	<?php echo CHtml::encode($data->min_resize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_resize')); ?>:</b>
	<?php echo CHtml::encode($data->type_resize); ?>
	<br />


</div>