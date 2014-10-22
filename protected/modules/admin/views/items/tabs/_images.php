<div class="pull-left"><?php echo $form->dropDownListRow($model,'min_resize', SiteOptions::model()->getListOptions(2, 'thumb'), array('class'=>'span2','maxlength'=>100, 'empty'=>'')); ?>

<?php echo $form->dropDownListRow($model,'type_resize', SiteOptions::model()->getListOptions(6, 'typeResize'), array('class'=>'span2','maxlength'=>100)); ?>

<?php echo $form->fileFieldRow($model, 'thumb');?>
</div>
<div class="pull-right">
    <?php if($model->thumbroot){ 
        echo CHtml::image('/upload/images/items/admin/'.$model->thumbroot->name_img);
        echo '<br>';
        echo CHtml::ajaxLink('Удалить', array('/admin/items/dellimage'), array(
            'data'=>array('id_item'=>$model->id_item),
            'success'=>"js:function(data){
                $('.pull-right img').remove();
                $('.pull-right a').remove();
            }"
        ));
    }?>
    
</div>
