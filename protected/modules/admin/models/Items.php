<?php

/**
 * This is the model class for table "cf_items".
 *
 * The followings are the available columns in table 'cf_items':
 * @property integer $id_item
 * @property string $name_item
 * @property integer $type_item
 * @property string $slug_item
 * @property integer $status_id
 */
class Items extends CActiveRecord
{
    public $menu_id;
    public $item_id;
    public $name_meta;
    public $title_meta;
    public $desc_meta;
    public $kay_meta;
    public $gallery_id;
    public $min_resize;
    public $type_resize;
    public $path;
    public $thumb;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Items the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function init()
    {
        $this->path = Yii::getPathOfAlias('webroot.upload.images.items').'/';
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cf_items';
	}

	public function behaviors(){
        return array( 'EAdvancedArBehavior' => array(
            'class' => 'application.behaviors.EAdvancedArBehavior'));
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_id, sort_item, gallery_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('name_item, slug_item, name_meta, type_item, title_meta, desc_meta, kay_meta, data_options', 'length', 'max'=>255),
            
            array('slug_item','ext.LocoTranslitFilter','translitAttribute'=>'name_item'),
            array('slug_item', 'unique'),
            array('desc_item, menu_id', 'safe'),
            array('thumb', 'file', 'maxSize'=>3145728, 'allowEmpty'=>true, 'types'=>'jpg, gif, png'), // 1024 * 1024 * 3  =  3 мегабайта
            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_item, name_item, type_item, slug_item, status_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'meta'=>array(self::HAS_ONE, 'Metadata', 'fk_id', 'condition'=>'model_id = 2'),
            'pages'=>array(self::MANY_MANY, 'Pages', 'cf_page_item(item_id, page_id)', 'condition'=>'status_id = 2', 'order'=>'sort_page ASC'),
            'type'=>array(self::BELONGS_TO, 'ItemType', 'type_item'),
            'status'=>array(self::BELONGS_TO, 'Status', 'status_id'),          
            'menu'=>array(self::MANY_MANY, 'Menu', 'cf_menu_items(item_id, menu_id)', 'index'=>'id_menu'),
            'thumbroot' => array(self::HAS_ONE, 'Images', 'fk_id', 'condition'=>'model_id = 2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        return array(
            'id_item' => '#',
            'name_item' => 'Название пункта',
            'type_item' => 'Тип пункта',
            'slug_item' => 'Url',
            'status_id' => 'Статус',
            'title_meta'=>'Заголовок',
            'desc_meta'=>'Мета-описание',
            'kay_meta'=>'Ключевые слова',
            'name_meta'=>'Второй заголовок',
            'menu_id'=>'Меню',
            'sort_item'=>'Сортировка',
            'data_options'=>'Дополнительные параметры',
            'gallery_id'=>'Выбирите галерею',
            'parent_id'=>'Родительская категория',
            'desc_item'=>'Описание',
            'thumb'=>'Привьюшка',
            'min_resize' => 'Миниатюры',
            'type_resize' => 'Тип обрезки',
        );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->order = 'id_item DESC';

		$criteria->compare('id_item',$this->id_item);
		$criteria->compare('name_item',$this->name_item,true);
		$criteria->compare('type_item',$this->type_item);
		$criteria->compare('slug_item',$this->slug_item,true);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pagesize'=>20,
            ),
		));
	}

    public function beforeDelete()
    {
        if(!empty($this->meta)){
            $this->meta->delete();
        }
        return parent::beforeDelete();
    }

    public function beforeSave()
    {
        if($this->gallery_id != ''){
            $this->data_options = $this->gallery_id;
        }
        return parent::beforeSave();
    }

    public function saveMeta()
    {
        if($this->title_meta!='' || $this->desc_meta!='' || $this->kay_meta!=''){
            if($this->meta){
                $model = Metadata::model()->findByAttributes(array('model_id'=>2, 'fk_id'=>$this->id_item));
            }else{
                $model = new Metadata;
            }
            $model->title_meta = $this->title_meta;
            $model->desc_meta = $this->desc_meta;
            $model->kay_meta = $this->kay_meta;
            $model->name_meta = $this->name_meta;
            $model->model_id = 2;
            if($this->meta){
                $model->save();
            }else{
                return $model;
            }
        }
    }

    protected function afterSave()
    {
        // загрузка миниатюры
        $thumb = CUploadedFile::getInstance($this, 'thumb');
        if(!empty($thumb))
        {
            $fileType = explode('.', $thumb->name);
            $fileName = uniqid();
            $fileName = $fileName.'.'.$fileType[1];
            
            if($thumb->saveAs($this->path.$fileName))
            {
                if(!empty($this->thumbroot)){
                    if(file_exists($this->path.$this->thumbroot->name_img)){
                        unlink($this->path.$this->thumbroot->name_img);
                    }
                    if(file_exists($this->path.'admin/'.$this->thumbroot->name_img)){
                        unlink($this->path.'admin/'.$this->thumbroot->name_img);
                    }
                    if(file_exists($this->path.'thumb/'.$this->thumbroot->name_img)){
                        unlink($this->path.'thumb/'.$this->thumbroot->name_img);
                    }
                    $this->thumbroot->delete();
                }
                $model = new Images;
                $model->model_id = 2;
                $model->fk_id = $this->id_item;
                $model->name_img = $fileName;
                $model->alt_img = $fileType[0];
                $model->sort_img = 1;
                $model->is_root = 1;

                if($model->save()){
                    $thumb = Yii::app()->phpThumb->create($this->path.$fileName);
                    $thumb->resize(100, 100);
                    $thumb->save($this->path.'admin/'.$fileName);
                    $minResize = $_POST['Items']['min_resize'];
                    $typeResize = $_POST['Items']['type_resize'];
                    if($minResize != ''){
                        $size = explode('x', $minResize);
                        if($typeResize == 'resize'){
                            $thumb = Yii::app()->phpThumb->create($this->path.$fileName);
                            $thumb->resize($size[0], $size[1]);
                            $thumb->save($this->path.'thumb/'.$fileName);
                        }elseif($typeResize == 'adaptive'){
                            $thumb = Yii::app()->phpThumb->create($this->path.$fileName);
                            $thumb->adaptiveResize($size[0], $size[1]);
                            $thumb->save($this->path.'thumb/'.$fileName);
                        }
                    }
                }
            }
        }
        return parent::afterSave();
    }

    public function getMeta()
    {
        if(isset($this->meta)){
            $this->title_meta = $this->meta->title_meta;
            $this->desc_meta = $this->meta->desc_meta;
            $this->kay_meta = $this->meta->kay_meta;
            $this->name_meta = $this->meta->name_meta;
        }
    }

    public function getList()
    {
        $model = self::model()->findAll();
        return CHtml::listData($model, 'id_item', 'name_item');
    }
}