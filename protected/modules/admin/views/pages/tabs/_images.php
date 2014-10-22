<div class="min-form-line">
    <div><?php echo $form->dropDownListRow($model,'min_resize', SiteOptions::model()->getListOptions(1, 'thumb'), array('class'=>'span2','maxlength'=>100, 'empty'=>'')); ?></div>

    <div><?php echo $form->dropDownListRow($model,'type_resize', SiteOptions::model()->getListOptions(6, 'typeResize'), array('class'=>'span2','maxlength'=>100)); ?></div>

    <div><?php echo $form->fileFieldRow($model, 'thumb');?></div>
    
    <div><?php if($model->thumbroot){ echo CHtml::image('/upload/images/pages/admin/'.$model->thumbroot->name_img); }?> </div>
</div>
<div class="clearfix"></div>
<hr />

<div><?php echo $form->dropDownListRow($model,'gallery_id', Gallery::model()->getList(), array('class'=>'span2','maxlength'=>100, 'empty'=>'')); ?></div>
<?php if($model->gallery):?>
    <?php echo CHtml::link($model->gallery->name_gallery, array('/admin/gallery/update', 'id'=>$model->gallery->id_gallery), array('target'=>'_blank')); ?>
    <div id="listImages" class="well well-small">
        <?php $path = Yii::app()->baseUrl.'/upload/images/'.$model->gallery->folder_gallery.'/admin/';
        foreach($model->gallery->getimages as $kay => $img){
            echo CHtml::image($path.$img->name_img, $img->alt_img, array('title'=>$img->alt_img, 'class'=>'img', 'id'=>$img->id_img));
            echo '<i class="icon-remove dellimage" id="'.$img->id_img.'"></i>';
        }?>
    </div>
<?php endif;?>