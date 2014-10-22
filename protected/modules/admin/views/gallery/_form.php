<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gallery-form',
    'type'=>'inline',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name_gallery',array('class'=>'span2','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'folder_gallery',array('class'=>'span2','maxlength'=>255, 'disabled'=>(!$model->isNewRecord) ? true : false)); ?>

	<?php echo $form->dropDownListRow($model,'min_resize', SiteOptions::model()->getListOptions(6, 'thumb'), array('class'=>'span2','maxlength'=>100, 'empty'=>'')); ?>

	<?php echo $form->dropDownListRow($model,'type_resize', SiteOptions::model()->getListOptions(6, 'typeResize'), array('class'=>'span2','maxlength'=>100)); ?>
    
    <?php echo $form->checkBoxRow($model, 'is_gallery');?>
    <br /><br />
    <?php if(!$model->isNewRecord){
        ($upload) ? $upload->showErrors() : '';
        echo $form->fileFieldRow($model,'images[]',array('multiple'=>'multiple'));
    }
    ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
	)); ?>

<?php $this->endWidget(); ?>
<?php if(!$model->isNewRecord){
        //echo '<div id="listImages" class="well well-small">';
        
        foreach($model->getimages as $kay => $img){
            //echo '<div>';
                //echo CHtml::image($path.$img->name_img, $img->alt_img, array('title'=>$img->alt_img, 'class'=>'img', 'id'=>$img->id_img));
                //echo '<i class="icon-remove dellimage" id="'.$img->id_img.'"></i>';
            //echo '</div>';
        }
        //echo '</div>';
    }
?>
<div class="well well-small">
    <div id="listImages">
        <?php $path = Yii::app()->baseUrl.'/upload/images/'.$model->folder_gallery;?>
        <?php foreach($model->getimages as $kay => $img):?>
            <div id="<?php echo $img->id_img?>">
                <?php echo CHtml::link(CHtml::image($path.'/admin/'.$img->name_img), $path.'/thumb/'.$img->name_img, array('class'=>'lightbox'));?>
                <span class="dellimage"><i class="icon-remove dell-image-i" id="<?php echo $img->id_img?>"></i></span>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="clearfix" style="clear: both;"></div>
</div>