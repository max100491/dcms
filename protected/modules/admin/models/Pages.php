<?php

/**
 * This is the model class for table "cf_pages".
 *
 * The followings are the available columns in table 'cf_pages':
 * @property integer $id_page
 * @property string $name_page
 * @property string $brief_text_page
 * @property string $text_page
 * @property string $slug_page
 * @property string $date_created
 * @property string $date_publication
 * @property integer $user_id
 * @property integer $status_id
 */
class Pages extends CActiveRecord
{
    public $path;
    public $item_id;
    public $name_meta;
    public $title_meta;
    public $desc_meta;
    public $kay_meta;
    public $thumb;
    public $min_resize;
    public $type_resize;
    public $item;
    public $folderImages = 'pages';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function init()
    {
        $this->path = Yii::getPathOfAlias('webroot.upload.images.pages').'/';
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cf_pages';
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
            array('name_page', 'required'),
			array('user_id, status_id, gallery_id, sort_page', 'numerical', 'integerOnly'=>true),
			array('name_page, slug_page, title_meta, kay_meta, name_meta', 'length', 'max'=>255),
			array('brief_text_page, text_page, desc_meta, date_created, date_publication', 'safe'),
            array('thumb', 'file', 'maxSize'=>3145728, 'allowEmpty'=>True, 'types'=>'jpg, gif, png'), // 1024 * 1024 * 3  =  3 мегабайта
            
            array('slug_page', 'ext.LocoTranslitFilter', 'translitAttribute'=>'name_page'),
            array('slug_page', 'unique'),
            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_page, name_page, brief_text_page, text_page, slug_page, date_created, date_publication, user_id, status_id, item', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'items' => array(self::MANY_MANY, 'Items', 'cf_page_item(page_id, item_id)', 'index'=>'id_item'),
            'meta' => array(self::HAS_ONE, 'Metadata', 'fk_id', 'condition'=>'model_id = 1'),
            'thumbroot' => array(self::HAS_ONE, 'Images', 'fk_id', 'condition'=>'model_id = 1'),
            'gallery'=>array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
            'status'=>array(self::BELONGS_TO, 'Status', 'status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_page' => 'Id',
			'name_page' => 'Название записи',
			'brief_text_page' => 'Краткое описание',
			'text_page' => 'Полное описание',
			'slug_page' => 'Транслит',
			'date_created' => 'Дата создания',
			'date_publication' => 'Дата публикации',
			'user_id' => 'Пользователь',
			'status_id' => 'Статус',
            'item_id'=>'Категория(и)',
            'title_meta'=>'Заголовок',
            'desc_meta'=>'Мета-описание',
            'kay_meta'=>'Ключевые слова',
            'name_meta'=>'Второй заголовок',
            'thumb'=>'Привьюшка',
            'min_resize' => 'Миниатюры',
			'type_resize' => 'Тип обрезки',
            'gallery_id'=>'Галерея',
            'sort_page'=>'Сортировка',
            'item'=>'Пункт меню',
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
        $criteria->order = 'id_page DESC';
        $criteria->with = array('items'=>array('together'=>true));

		$criteria->compare('id_page',$this->id_page);
		$criteria->compare('name_page',$this->name_page,true);
		$criteria->compare('brief_text_page',$this->brief_text_page,true);
		$criteria->compare('text_page',$this->text_page,true);
		$criteria->compare('slug_page',$this->slug_page,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_publication',$this->date_publication,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status_id',$this->status_id);
        $criteria->compare('items.id_item',$this->item);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pagesize'=>20,
            ),
		));
	}
    protected function beforeSave()
    {
        $this->date_publication = date('Y-m-d', strtotime($this->date_publication));
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
            $this->date_created = new CDbExpression('NOW()');
            if($this->date_publication == ''){
                $this->date_publication = new CDbExpression('NOW()');
            }
        }
        return parent::beforeSave();
    }
    
    public function beforeDelete()
    {
        if(!empty($this->meta)){
            $this->meta->delete();
        }
        if(!empty($this->thumbroot)){
            $this->thumbroot->delete();
        }
        return parent::beforeDelete();
    }
    
    protected function afterFind()
    {
        return parent::afterFind();
    }
    
    
    protected function afterSave()
    {
        return parent::afterSave();
    }
    
    
    public function saveMeta()
    {
        if($this->title_meta!='' || $this->desc_meta!='' || $this->kay_meta!=''){
            if($this->meta){
                $model = Metadata::model()->findByAttributes(array('model_id'=>1, 'fk_id'=>$this->id_page));
            }else{
                $model = new Metadata;
            }
            $model->title_meta = $this->title_meta;
            $model->desc_meta = $this->desc_meta;
            $model->kay_meta = $this->kay_meta;
            $model->name_meta = $this->name_meta;
            $model->model_id = 1;
            if($this->meta){
                $model->save();
            }else{
                return $model;
            }
        }
    }
    
    public function getCategory($model)
    {
        $txt = '';
        foreach($model as $item){
            $txt .= CHtml::link($item->name_item, array('/admin/items/update', 'id'=>$item->id_item)).' ';
        }
        return $txt;
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