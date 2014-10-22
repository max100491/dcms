<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id_meta',array('class'=>'span5')); ?>

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
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
