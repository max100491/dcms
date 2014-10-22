<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'items-form',
    'type'=>'#',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldRow($model,'name_item',array('class'=>'span4','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($model,'menu_id', Menu::getList(), array('class'=>'span2', 'empty'=>'')); ?>
    
    <?php echo $form->dropDownListRow($model,'parent_id', Items::getList(), array('class'=>'span2', 'empty'=>'')); ?>
    
    <?php echo $form->dropDownListRow($model,'type_item', HelperAdmin::getListTypeItem(), array('class'=>'span2', 'empty'=>'')); ?>
    <div style="display: none;" id="gallery_id">
        <?php echo $form->dropDownListRow($model,'gallery_id', Gallery::getList(), array('class'=>'span2', 'empty'=>'')); ?>
    </div>
        
    <br />    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Создать',
	)); ?>

<?php $this->endWidget(); ?>
