<?php

class Items extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'cf_items';
	}

	public function rules()
	{
		return array(
			array('parent_id, type_item, status_id, sort_item', 'numerical', 'integerOnly'=>true),
			array('name_item, slug_item, data_options, url', 'length', 'max'=>255),
			array('desc_item', 'safe'),
			array('id_item, name_item, parent_id, type_item, slug_item, status_id, sort_item, data_options, url, desc_item', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
            'meta'=>array(self::HAS_ONE, 'Metadata', 'fk_id', 'condition'=>'model_id = 2'),
            'pages'=>array(self::MANY_MANY, 'Pages', 'cf_page_item(item_id, page_id)', 'condition'=>'status_id = 2', 'order'=>'sort_page ASC'),
            'type'=>array(self::BELONGS_TO, 'ItemType', 'type_item'),
            'status'=>array(self::BELONGS_TO, 'Status', 'status_id'),          
            'menu'=>array(self::MANY_MANY, 'Menu', 'cf_menu_items(item_id, menu_id)', 'index'=>'id_menu'),
            'thumbroot' => array(self::HAS_ONE, 'Images', 'fk_id', 'condition'=>'model_id = 2'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id_item' => 'Id Item',
			'name_item' => 'Name Item',
			'parent_id' => 'Parent',
			'type_item' => 'Type Item',
			'slug_item' => 'Slug Item',
			'status_id' => 'Status',
			'sort_item' => 'Sort Item',
			'data_options' => 'Data Options',
			'url' => 'Url',
			'desc_item' => 'Desc Item',
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id_item',$this->id_item);
		$criteria->compare('name_item',$this->name_item,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('type_item',$this->type_item);
		$criteria->compare('slug_item',$this->slug_item,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('sort_item',$this->sort_item);
		$criteria->compare('data_options',$this->data_options,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('desc_item',$this->desc_item,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
