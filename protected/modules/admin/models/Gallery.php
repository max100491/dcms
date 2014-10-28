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
            array('id_gallery', 'numerical'),
            array('folder_gallery', 'unique'),
            array('folder_gallery', 'match', 'pattern'=>'/^[\w]+$/', 'message'=>'Недоступное имя для папки'),
			array('name_gallery, folder_gallery', 'length', 'max'=>255),
			array('min_resize, type_resize', 'length', 'max'=>100),
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
			'name_gallery' => 'Заголовок галереи',
			'folder_gallery' => 'Папка (латинскими)',
			'min_resize' => 'Миниатюры',
			'type_resize' => 'Тип обрезки',
		);
	}

    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;
        $criteria->order = 'id_gallery DESC';

        $criteria->compare('id_gallery',$this->id_gallery);
        $criteria->compare('name_gallery',$this->name_gallery,true);

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

    public function resizeImage()
    {
        // 'value'=>'name'
        // '200x200'=>'Загрузка миниатюр'
        return array_merge(Yii::app()->params['resizeImage'],
            array(
                '200x200'=>'Загрузка миниатюр'
            )
        );
    }
    
}