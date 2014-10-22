<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name_gallery',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'folder_gallery',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'min_resize',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'type_resize',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
