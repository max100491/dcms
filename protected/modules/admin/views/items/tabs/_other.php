<?php echo $form->textFieldRow($model,'slug_item',array('class'=>'span6','maxlength'=>255)); ?>

<?php if($model->isNewRecord){$model->status_id = 2;} ?>
<?php echo $form->dropDownListRow($model,'status_id', Status::model()->getList(), array('class'=>'span6')); ?>