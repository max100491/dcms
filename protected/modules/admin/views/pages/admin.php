<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

echo '';

$this->menu=array(
	array('label'=>'<i class="icon-file icon-white" title="Создать"></i>','url'=>array('create')),
);
$this->title = 'Все';

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pages-grid',
    'type'=>'striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_page'=>array(
            'name'=>'id_page',
            'htmlOptions'=>array(
                'width'=>50,
            ),
        ),
		'name_page'=>array(
            'name'=>'name_page',
            'type'=>'html',
            'value'=>'CHtml::link($data->name_page, array("/admin/pages/update", "id"=>$data->id_page))',
        ),
        'item'=>array(
            'name'=>'item',
            'type'=>'html',
            'value'=>'Pages::model()->getCategory($data->items)',
        ),
        'date_publication'=>array(
            'name'=>'date_publication',
            'value'=>'date("d.m.Y", strtotime($data->date_publication))',
            'htmlOptions'=>array(
                'width'=>100,
                'style'=>'text-align:center',
            ),
            'filter' => $this->widget(
                'zii.widgets.jui.CJuiDatePicker',
                array(
                    'model' => $model,
                    'attribute' => 'date_publication',
                    'language'=>'ru'
                ),
                true
            ),
        ),
		'status_id'=>array(
            'name'=>'status_id',
            'filter'=>Status::model()->getList(),
            'value'=>'$data->status->name_status',
            'htmlOptions'=>array(
                'width'=>50,
            )
        ),
		/**/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); 
?>