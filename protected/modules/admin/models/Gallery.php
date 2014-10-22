<?php
class Gallery extends CActiveRecord
{
    public $images;
    public $path;
    
    public function init()
    {
        $this->path = Yii::getPathOfAlias('webroot.upload.images');
    }
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'cf_gallery';
	}


	public function rules()
	{
		return array(
            array('name_gallery, folder_gallery', 'required'),
            array('is_gallery', 'numerical'),
            array('folder_gallery', 'unique'),
            array('folder_gallery', 'match', 'pattern'=>'/^[\w]+$/', 'message'=>'Недоступное имя для папки'),
			array('name_gallery, folder_gallery', 'length', 'max'=>255),
			array('min_resize, type_resize', 'length', 'max'=>100),
			array('id_gallery, name_gallery, folder_gallery, min_resize, type_resize', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		return array(
            'getimages'=>array(self::HAS_MANY, 'Images', 'fk_id', 'condition'=>'model_id = 6', 'order'=>'sort_img ASC'),
            'getimage'=>array(self::HAS_ONE, 'Images', 'fk_id', 'condition'=>'model_id = 6'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'id_gallery' => '#',
			'name_gallery' => 'Имя',
			'folder_gallery' => 'Папка',
			'min_resize' => 'Миниатюры',
			'type_resize' => 'Тип обрезки',
            'is_gallery' => 'Использовать как галерею',
            'images[]' => '',
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id_gallery',$this->id_gallery);
		$criteria->compare('name_gallery',$this->name_gallery,true);
		$criteria->compare('folder_gallery',$this->folder_gallery,true);
		$criteria->compare('min_resize',$this->min_resize,true);
		$criteria->compare('type_resize',$this->type_resize,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pagesize'=>20,
            ),
		));
	}
    
    public function getList()
    {
        $model = self::model()->findAll();
        return CHtml::listData($model, 'id_gallery', 'name_gallery');
    }
       
    public function beforeValidate()
    {
        if(!file_exists($this->path) && !is_writable($this->path))
        {
            $this->addError('folder_gallery', 'Невозможно создать папку в каталоге '.$this->path.' проверти существование пути и разрешите записывать файлы (права 777)');
        }
        return parent::beforeValidate();
    }
    
    public function beforeSave()
    {
        if($this->isNewRecord){
            mkdir($this->path.'/'.$this->folder_gallery, 0755);
            mkdir($this->path.'/'.$this->folder_gallery.'/thumb', 0755);
            mkdir($this->path.'/'.$this->folder_gallery.'/admin', 0755);
        }
        return parent::beforeSave();
    }
    
    public function beforeDelete()
    {
        foreach($this->getimages as $img){
            if(file_exists($this->path.'/'.$this->folder_gallery.'/'.$img->name_img)){
                unlink($this->path.'/'.$this->folder_gallery.'/'.$img->name_img);
            }
            if(file_exists($this->path.'/'.$this->folder_gallery.'/admin/'.$img->name_img)){
                unlink($this->path.'/'.$this->folder_gallery.'/admin/'.$img->name_img);
            }
            if(file_exists($this->path.'/'.$this->folder_gallery.'/thumb/'.$img->name_img)){
                unlink($this->path.'/'.$this->folder_gallery.'/thumb/'.$img->name_img);
            }
            $img->delete();
        }
        rmdir($this->path.'/'.$this->folder_gallery.'/admin');
        rmdir($this->path.'/'.$this->folder_gallery.'/thumb');
        rmdir($this->path.'/'.$this->folder_gallery);
        return parent::beforeDelete();
    }
    
}