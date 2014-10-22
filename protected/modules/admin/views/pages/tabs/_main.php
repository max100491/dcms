<div class="width100">
    <?php echo $form->textFieldRow($model,'name_page',array('maxlength'=>255)); ?>
    
    <?php
        Yii::import('ext.chosen.Chosen');
        echo $form->labelEx($model, 'item_id');
    	echo Chosen::multiSelect('item_id', $model->items, Items::model()->getList(), array('style'=>'width:99%'));
    ?><br /><br />
    
    <?php echo $form->textAreaRow($model,'brief_text_page',array('rows'=>6, 'cols'=>50)); ?>
    
    <?php echo $form->textAreaRow($model,'text_page',array('rows'=>6, 'cols'=>50, 'class'=>'span8 tiny-mce')); ?>
</div>