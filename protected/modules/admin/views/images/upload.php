<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'images-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'model_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fk_id',array('class'=>'span5')); ?>

	<?php echo $form->fileFieldRow($model,'images[]',array('multiple'=>'multiple')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>