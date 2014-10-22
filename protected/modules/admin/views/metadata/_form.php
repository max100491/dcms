<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'metadata-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'model_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fk_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name_meta',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textFieldRow($model,'title_meta',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textAreaRow($model,'desc_meta',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'kay_meta',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
