<div class="row">
    <div class="span4 offset4 well" style="margin-top: 50px;">
        <legend>Войти</legend>
        <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'login-form',
        	'enableClientValidation'=>true,
        	'clientOptions'=>array(
        		'validateOnSubmit'=>true,
        	),
        )); ?>
        <?php if(!empty($model->errors)):?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <?php echo CHtml::errorSummary($model, '');?>
        </div>
        <?php endif;?>
    	<?php echo $form->textField($model,'username', array('placeholder'=>$model->getAttributeLabel('username'), 'class'=>'input-block-level')); ?>
    	<?php echo $form->error($model,'username'); ?>
    	
        <?php echo $form->passwordField($model,'password', array('placeholder'=>$model->getAttributeLabel('password'), 'class'=>'input-block-level')); ?>
    	<?php echo $form->error($model,'password'); ?>
        
    	<label class="checkbox">
            <?php echo $form->checkBox($model,'rememberMe'); echo $model->getAttributeLabel('rememberMe')?>
    	</label>
        
        <div class="">
            <?php echo CHtml::submitButton('Войти', array('class'=>'btn btn-info')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->