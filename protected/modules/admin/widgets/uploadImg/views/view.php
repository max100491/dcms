<div class="well">
    <div class="row-fluid">
        <div class="span1">
        <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id'=>CHtml::activeId($this->model, 'upload'),
                    'config'=>array(
                        'action'=>$this->action,
                        'allowedExtensions'=>$this->allowedExtensions,
                        'sizeLimit'=>$this->sizeLimit,
                        'minSizeLimit'=>$this->minSizeLimit,
                        'params'=>$params,
                        // 'onComplete'=>"js:function(id, fileName, responseJSON) {}",
                        //'messages'=>array(
                        //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                        //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                        //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                        //                  'emptyError'=>"{file} is empty, please select files again without it.",
                        //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                        //                 ),
                        //'showMessage'=>"js:function(message){ alert(message); }"
                    )
                )
            );
        ?>
        </div>

        <div class="span2">
            <?php echo CHtml::dropDownList(CHtml::activeName($this->model, 'min_resize'), '', $this->resize, array('class'=>'span12')); ?>
        </div>

        <div class="span2">
            <?php echo CHtml::dropDownList(CHtml::activeName($this->model, 'type_resize'), '', $this->type_resize, array('class'=>'span12')); ?>
        </div>

        <div class="span7">
            <div class="btn-group">
                <?php echo CHtml::link('Изменить размер', array('/admin/images/resize'), array('class'=>'btn btn-success resize-files'));?>
                <?php echo CHtml::link('Сделать главным', '', array('class'=>'btn'));?>
                <?php echo CHtml::link('Отменить все', '#', array('class'=>'btn btn-info check-all'));?>
                <?php echo CHtml::link('Снять выде..', '#', array('class'=>'btn btn-info no-check-all'));?>
                <?php echo CHtml::link('Удалить файлы', '', array('class'=>'btn btn-danger remove-files'));?>
            </div>
        </div>
    </div>
    <div class="row-flid">
        <div>
            <p><?php echo count($images);?> изображений в этой галереи</p>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row-fluid list-image">
    <ul class="well">
        <?php foreach($images as $key=>$image):?>
            <li class="<?php echo ($image['is_root']) ? 'active' : ''?>">

                <div class="image-panel"><!-- Дополнительная панель к изображению -->
                    
                    <?php echo CHtml::link(
                        '<i class="icon-trash"></i>',
                        array('/admin/images/delete',
                            'id'=>$image['id_img'],
                            'folder'=>$this->folder
                        ), array('class'=>'remove'));
                    ?>

                    <?php echo CHtml::checkBox('file', '');?>

                </div><!-- Дополнительная панель конец -->

                <?php echo CHtml::image(
                    DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.$image['name_img'],
                    $image['alt_img']
                ); ?>

            </li>
        <?php endforeach;?>
        <div class="clearfix"></div>
    </ul>
</div>