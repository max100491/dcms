<li class="span2">
    <a href="<?php echo '/upload/images/'.$data->gallery->folder_gallery.'/'.$data->name_img ?>" class="thumbnail lightbox" rel="tooltip" data-title="<?php echo $data->alt_img?>">
       <?php echo CHtml::image('/upload/images/'.$data->gallery->folder_gallery.'/thumb/'.$data->name_img, $data->alt_img);?>
    </a>
</li>