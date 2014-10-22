<?php
if($model->isNewRecord){$model->status_id = 2;}
echo $form->dropDownListRow($model,'status_id', Status::model()->getList()); ?>

<?php echo $form->textFieldRow($model,'slug_page',array('class'=>'span5','maxlength'=>255)); 
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model'=>$model,
        'attribute'=>'date_publication',
        'language'=>'ru',
        'options'=>array(
            'showAnim'=>'drop', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
            'dateFormat'=>'dd.mm.yy',
        ),
        'htmlOptions'=>array(
            'value'=>(!$model->isNewRecord) ? date('d.m.Y', strtotime($model->date_publication)) : date('d.m.Y'),
        ),
    ));
?>