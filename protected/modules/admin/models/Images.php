<?php

class Images extends CActiveRecord
{
    public $folder;
    public $qqfile;
    public $originalPath;
    public $path;
          
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'cf_images';
	}

	public function rules()
	{
		return array(
			array('name_img', 'required'),
			array('model_id, fk_id, sort_img, is_root', 'numerical', 'integerOnly'=>true),
			array('name_img, alt_img, folder', 'length', 'max'=>255),
			array('folder, qqfile', 'safe'),
			array('id_img, model_id, fk_id, name_img, alt_img, sort_img', 'safe', 'on'=>'search'),
		);
	}

	public function beforeDelete()
	{
		$this->path = Yii::getPathOfAlias('webroot.upload.images');
		$this->originalPath = $this->path.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR;

		if(file_exists($this->originalPath.$this->name_img))
            unlink($this->originalPath.$this->name_img);

        if(file_exists($this->originalPath.'admin'.DIRECTORY_SEPARATOR.$this->name_img))
            unlink($this->originalPath.'admin'.DIRECTORY_SEPARATOR.$this->name_img);

        if(file_exists($this->originalPath.'thumb'.DIRECTORY_SEPARATOR.$this->name_img))
            unlink($this->originalPath.'thumb'.DIRECTORY_SEPARATOR.$this->name_img);

		return parent::beforeDelete();
	}

	public function beforeSave()
	{
		$this->path = Yii::getPathOfAlias('webroot.upload.images');
		$this->originalPath = $this->path.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR;
		if ($this->isNewRecord) {
			$thumb = Yii::app()->phpThumb->create($this->originalPath.$this->qqfile);
			$thumb->resize(900, 900);
			$thumb->save($this->originalPath.$this->name_img);
			unlink($this->originalPath.$this->qqfile);
			$this->thumpAdmin();
		}
		return parent::beforeSave();
	}

	public function thumpAdmin()
	{
		$thumb = Yii::app()->phpThumb->create($this->originalPath.$this->name_img);
		$thumb->adaptiveResize(96, 96);
		$thumb->save($this->originalPath.'admin'.DIRECTORY_SEPARATOR.$this->name_img);
	}


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
}