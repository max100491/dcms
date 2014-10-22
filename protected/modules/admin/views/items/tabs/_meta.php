<div class="width100">
    <?php $model->getMeta();?>
    <?php echo $form->textFieldRow($model,'title_meta',array('maxlength'=>255)); ?>
    <?php //echo $form->textFieldRow($model,'name_meta',array('maxlength'=>255)); ?>
    <?php echo $form->textAreaRow($model,'desc_meta',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model,'kay_meta',array('maxlength'=>255)); ?>
</div>