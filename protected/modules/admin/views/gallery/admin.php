<?php
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	'Manage',
);

$this->menu=array(
	// array('label'=>'<i class="icon-file icon-white" title="Создать"></i>','url'=>array('create')),
);
?>

<div class="row-fluid">

	<div class="span6">
		<?php
			$this->widget('bootstrap.widgets.TbGridView',array(
				'id'=>'items-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
					array(
						'name'=>'id_gallery'
					),
					array(
						'name'=>'name_gallery'
					),
					array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
			            'template'=>'{update}{delete}',
					),
				),
			));
		?>
	</div>

	<div class="span6">
		<div style="height: 60px;"></div>
		<?php $this->widget('application.modules.admin.widgets.Dynatree.Dynatree', array(
		    'tree' => $tree,

		    'actions' => array(
		        'create' => $this->createUrl('gallery/create'),
		        'move' => $this->createUrl('gallery/move'),
		        // 'delete' => $this->createUrl('gallery/delete'),
		    ),

		    'js_options' => array(
		        'menu_opts' => array(
		            'page_data' => false,
		        ),
		        'hide_url' => true,
		        'dblclick' => 'js:function (node) {
		            Gs.moveCatUpdate(node);
		        }',
		        'onEdit' => 'js:function (node) {
		            Gs.moveCatUpdate(node);
		        }',
		    ),

		    'link_options' => array(
		        'url' => $this->createUrl('gallery/update', array('id' => '--href--')),
		        'href_node' => 'id',
		        'text_node' => 'title',
		        'display_url' => false,
		    ),
		)); ?>
	</div>

</div>