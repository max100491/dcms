<li class="span2">
    <a href="<?php echo Yii::app()->createUrl('/gallery/list', array('id'=>$data->id_gallery));?>" class="thumbnail" rel="tooltip" data-title="<?php echo $data->name_gallery?>">
       <?php echo CHtml::image('/upload/images/'.$data->folder_gallery.'/thumb/'.$data->getimage->name_img, '', array('width'=>150));?>
    </a>
</li>