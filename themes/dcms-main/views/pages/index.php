<?php if($model):?>
    <?php foreach($model as $page):?>
            <h1><?php echo $page->name_page?></h1>
            <?php if($page->thumbroot){ echo CHtml::link(CHtml::image('/upload/images/pages/thumb/'.$page->thumbroot->name_img), '/upload/images/pages/'.$page->thumbroot->name_img, array('class'=>'lightbox'));}?>
            <?php //echo date('d.m.Y', strtotime($page->date_publication)); ?> <!-- Дата создания -->
            <?php echo $page->text_page?> <!-- Полное описание -->
            <?php /*$this->widget('application.modules.comments.widgets.listform.DComments', array(
                'model'=>1,
                'id'=>$page->id_page,
            ));*/?>
    <?php endforeach;?>
<?php else:?>
    <h3>Сайт находится в разработке</h3>
<?php endif;?>