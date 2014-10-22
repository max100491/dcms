<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'items-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
    ),
)); ?>

        <?php echo $form->errorSummary($model); ?>
        <?php $this->widget('bootstrap.widgets.TbTabs', array(
            'tabs'=>array(
                array("label" => "Обязательно", "content" => $this->renderPartial('tabs/_main', array('form'=>$form, 'model'=>$model),true,false), "active" => true),
                array("label" => "Описание", "content" => $this->renderPartial('tabs/_desc', array('form'=>$form, 'model'=>$model),true,false)),
        		array("label" => "Изображение", "content" => $this->renderPartial('tabs/_images', array('form'=>$form, 'model'=>$model),true,false)),
        		array("label" => "Мета-данные", "content" => $this->renderPartial('tabs/_meta', array('form'=>$form, 'model'=>$model),true,false)),
                array("label" => "Прочее", "content" => $this->renderPartial('tabs/_other', array('form'=>$form, 'model'=>$model),true,false)),
            ),
        )); ?>
        
    <?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
	)); ?>

<?php $this->endWidget(); ?>
