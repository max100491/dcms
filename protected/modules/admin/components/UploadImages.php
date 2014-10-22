<?php
class UploadImages
{
    public $files = array();
    public $errors = array();
    
    public function saveImg($model, $attribute)
    {
        $this->files = CUploadedFile::getInstances($model, $attribute);
        if(!empty($this->files)){
            foreach($this->files as $image)
            {    
                $explodFile = explode('.', $image->name);
                $filename = uniqid().'.'.$explodFile[1];
    
                $modelImage = new UploadImagesModel;
                $modelImage->image = $image;
                $modelImage->model_id = 6;
                $modelImage->fk_id = $model->id_gallery;   
                $modelImage->name_img = $filename;
                $modelImage->alt_img = $explodFile[0];
    
                if($modelImage->save()){
                    $image->saveAs($model->path.'/'.$model->folder_gallery.'/'.$filename);
                    $this->thumpAdmin($model->path.'/'.$model->folder_gallery.'/', $filename);
                    $this->resizeImg($model->path.'/'.$model->folder_gallery.'/', $filename);
                }else{
                    $errors[] = $modelImage->getError('image');
                    $this->errors = $errors;
                }
    
                $modelImage->id_img = false;
                $modelImage->isNewRecord = true;
            }
        }
    }

    public function thumpAdmin($path, $filename)
    {
        $thumb = Yii::app()->phpThumb->create($path.$filename);
        $thumb->adaptiveResize(96, 96);
        $thumb->save($path.'admin/'.$filename);
    }
    
    
    /**
     * Вызывается при каждой итерации цикла в методе saveImg()
     * Делает обрезку изображений в зависимости от выбранных опций в списке "Миниатюры" и "Тип Обрезки"
     */
    public function resizeImg($path, $filename)
    {
        $minResize = $_POST['Gallery']['min_resize'];
        $typeResize = $_POST['Gallery']['type_resize'];
        if($minResize != ''){
            $size = explode('x', $minResize);
            if($typeResize == 'resize'){
                $thumb = Yii::app()->phpThumb->create($path.$filename);
                $thumb->resize($size[0], $size[1]);
                $thumb->save($path.'thumb/'.$filename);
            }elseif($typeResize == 'adaptive'){
                $thumb = Yii::app()->phpThumb->create($path.$filename);
                $thumb->adaptiveResize($size[0], $size[1]);
                $thumb->save($path.'thumb/'.$filename);
            }
        }
    }
    
    public function showErrors()
    {
        if(!empty($this->errors))
        {
            $txt = '<div class="alert alert-block alert-error"><ul>';
                foreach($this->errors as $error){
                    $txt .= '<li>'.$error.'</li>';
                }
            $txt .= '</ul></div>';
            echo $txt;
        }
    }
    
    public function updateResize($model)
    {
        if($model->min_resize!=null){
            $size = explode('x', $model->min_resize);
            $typeResize = $model->type_resize;
            $path = $model->path.'/'.$model->folder_gallery.'/';
            foreach($model->getimages as $img){
                if($typeResize == 'resize'){
                    $thumb = Yii::app()->phpThumb->create($path.$img->name_img);
                    $thumb->resize($size[0], $size[1]);
                    $thumb->save($path.'thumb/'.$img->name_img);
                }elseif($typeResize == 'adaptive'){
                    $thumb = Yii::app()->phpThumb->create($path.$img->name_img);
                    $thumb->adaptiveResize($size[0], $size[1]);
                    $thumb->save($path.'thumb/'.$img->name_img);
                }
            }
        }
    }
}
?>