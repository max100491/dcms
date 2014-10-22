<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'id'=>array(
                'name'=>'id',
                'htmlOptions'=>array(
                    'class'=>'primaryKey'
                ),
            ),
            'name',
            'desc',
            'status',
            'sis_name',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>"{install} {delete}",
                'buttons'=>array(
                    'install' => array(
                        'label'=>'Установить',    
                        'icon'=>'icon-download-alt', 
                        'options'=>array(
                            'data-toggle'=>'modal',
                            'data-target'=>'#myModal'
                        ),
                        'click'=>"function(){
                            var folder = $(this).parent().prev();
                            var status = folder.prev();
                            var desc = status.prev();
                            var name = desc.prev();
                            var pk = name.prev();
                            $('.modal-header h4').html(name.text());
                            $('#idmodule').attr('value', pk.text());
                            $('#folder').attr('value', folder.text());
                        }"
                    )
                )
            )
        ),
    ));
?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Установка</h4>
    </div>
     
    <div class="modal-body">
        <?php echo CHtml::form('', 'post', array(
            'id'=>'installfomr'
        ));?>
            <?php echo CHtml::hiddenField('idmodule');?>
            <?php echo CHtml::hiddenField('folder');?>
        <?php echo CHtml::endForm();?>
        <div id="updatesuccess"></div>
    </div>
     
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'buttonType'=>'ajaxButton',
            'label'=>'Проверить',
            'url'=>'/admin/modules/verify',
            'ajaxOptions'=>array(
                'type'=>'post',
                'dataType'=>'script',
                // 'update'=>"#updatesuccess",
                'data'=>"js:$('#installfomr').serialize()",
            ),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Отмена',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>
 
<?php $this->endWidget(); ?>