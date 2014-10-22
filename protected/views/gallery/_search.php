<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id_gallery',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name_gallery',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'folder_gallery',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'min_resize',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'type_resize',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
