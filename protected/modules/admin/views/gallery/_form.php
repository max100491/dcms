<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gallery-form',
    'type'=>'inline',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name_gallery',array('class'=>'span6','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'folder_gallery',array('class'=>'span6','maxlength'=>255, 'disabled'=>(!$model->isNewRecord) ? true : false)); ?>
    
    <hr>
    <?php 
        $this->widget('application.modules.admin.widgets.uploadImg.AUploadImg', array(
            'model'=>$model,
        ));
    ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
	)); ?>

<?php $this->endWidget(); ?>