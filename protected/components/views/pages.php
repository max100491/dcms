<div>
    <?php foreach($model as $pages):?>
        <div>
            <?php echo $pages->name_page; ?>
            <?php echo ($page->thumbroot->name_img != null) ? CHtml::image('/upload/images/pages/thumb/'.$page->thumbroot->name_img) : '' ;?>
            <p><?php echo $pages->brief_text_page?></p>
        </div>
    <?php endforeach;?>
</div>