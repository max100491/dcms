<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'site-options-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldRow($model,'label_option',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'name_option',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'value_option',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->dropDownListRow($model,'model_id', HelperAdmin::getListModelId(), array('class'=>'span5')); ?>
<br />
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
	)); ?>

<?php $this->endWidget(); ?>
