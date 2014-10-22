<div class="news">
    <h2><?php echo CHtml::link($data->name_page, array('/news/index', 'id'=>$data->id_page)); ?></h2> <!-- end Название статьи -->
    <?php echo date('d.m.Y', strtotime($data->date_publication)); ?> <!-- end Тата публикации -->
    <?php 
        if($data->thumbroot){
            echo CHtml::link(
            CHtml::image('/upload/images/pages/thumb/'.$data->thumbroot->name_img),
                '/upload/images/pages/'.$data->thumbroot->name_img, 
                array('class'=>'lightbox')
            );
        }
    ?> <!-- end Вывод миниатюры -->
    <?php echo $data->brief_text_page; ?> <!-- end Краткое описание -->
</div>
<hr />