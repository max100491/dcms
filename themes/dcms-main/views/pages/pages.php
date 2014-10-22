<?php if($model):?>
    <h1><?php echo $model->name_item; ?></h1>
    <?php echo $model->desc_item; ?>
    <?php $this->widget('zii.widgets.CListView',array(
    	'dataProvider'=>$dataProvider,
        'itemView'=>'_pages'
    )); ?>
<?php else:?>
    <h3>Сайт находится в разработке</h3>
<?php endif;?>