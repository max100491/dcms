<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_page')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_page),array('view','id'=>$data->id_page)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_page')); ?>:</b>
	<?php echo CHtml::encode($data->name_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brief_text_page')); ?>:</b>
	<?php echo CHtml::encode($data->brief_text_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_page')); ?>:</b>
	<?php echo CHtml::encode($data->text_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug_page')); ?>:</b>
	<?php echo CHtml::encode($data->slug_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_publication')); ?>:</b>
	<?php echo CHtml::encode($data->date_publication); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

	*/ ?>

</div>