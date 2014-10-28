<style type="text/css">
#Items_menu_id label{
    display:inline;
}
#Items_menu_id input{
    margin-left: 10px;
    margin-top: -1px;
}
</style>
<?php echo $form->textFieldRow($model,'name_item',array('class'=>'span6','maxlength'=>255)); ?>

<?php //echo $form->dropDownListRow($model,'menu_id', Menu::getList(), array('class'=>'span6', 'empty'=>'')); ?>

<div class="control-group ">
    <?php echo $form->labelEx($model, 'menu_id', array('class'=>'control-label'));?>
    <div class="controls">
        <?php echo CHtml::checkBoxList('Items[menu_id]', array_keys($model->menu), Menu::model()->getList(), array('separator'=>'')); ?>
    </div>
</div>

<?php echo $form->dropDownListRow($model,'parent_id', Items::model()->getList(), array('class'=>'span6', 'empty'=>'')); ?>

<?php echo $form->dropDownListRow($model,'type_item', HelperAdmin::getListTypeItem(), array('class'=>'span6', 'empty'=>'')); ?>
<div style="display: none;" id="gallery_id">
    <?php echo $form->dropDownListRow($model,'gallery_id', Gallery::model()->getList(), array('class'=>'span6', 'empty'=>'')); ?>
</div>