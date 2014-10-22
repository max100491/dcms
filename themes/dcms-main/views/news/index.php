<h1><?php echo $page->name_page?></h1>
<?php if($page->meta->title_meta == ''){
    $this->title = $page->name_page; // если title_meta незаполнен title присваевает название статьи 
}else{
    $this->title = $page->meta->title_meta;
}?>
<?php if($page->thumbroot){ echo CHtml::link(CHtml::image('/upload/images/pages/thumb/'.$page->thumbroot->name_img), '/upload/images/pages/'.$page->thumbroot->name_img, array('class'=>'lightbox'));}?>
<?php echo date('d.m.Y', strtotime($page->date_publication)); ?> <!-- Дата создания -->
<?php echo $page->text_page?> <!-- Полное описание -->