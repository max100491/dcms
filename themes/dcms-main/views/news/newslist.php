<?php if($model):?>
    <?php if(empty($parent)):?>
        <?php $this->widget('zii.widgets.CListView',array(
        	'dataProvider'=>$dataProvider,
            'itemView'=>'_newslist'
        )); ?>
    <?php else:?>
        <?php foreach($parent as $pr):?>
            <div class="newsitem">
                <h1><?php echo $pr->name_item;?></h1>
                <?php foreach($pr->pages(array('limit'=>'3')) as $page):?>
                    <div class="news">
                        <?php echo ($page->thumbroot->name_img != null) ? CHtml::image('/upload/images/pages/thumb/'.$page->thumbroot->name_img) : '';?>
                        <?php echo CHtml::link($page->name_page, array('/news/index', 'id'=>$page->name_page));?>
                        <?php echo $page->brief_text_page;?>
                    </div>
                <?php endforeach;?>
            </div>            
        <?php endforeach;?>
    <?php endif;?>
<?php else:?>
    <h3>Сайт находится в разработке</h3>
<?php endif;?>