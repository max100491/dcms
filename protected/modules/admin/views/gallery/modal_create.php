<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Добавить галерею</h3>
</div>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'gallery-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'row-fluid')
)); ?>

    <div class="modal-body">

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow($model,'name_gallery', array('class'=>'span12')); ?>

        <?php echo $form->textFieldRow($model,'folder_gallery', array('class'=>'span12')); ?>

    </div>

<?php $this->endWidget(); ?>

<div class="modal-footer">
    <a href="#" class="btn">Закрыть</a>
    <a href="#" class="btn btn-primary" id="add-gallery">Добавить галерею</a>
</div>
