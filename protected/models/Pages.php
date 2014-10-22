<?php

class Pages extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'cf_pages';
	}

	public function rules()
	{
		return array(
			array('user_id, status_id, sort_page, gallery_id, count_view', 'numerical', 'integerOnly'=>true),
			array('name_page, slug_page, url', 'length', 'max'=>255),
			array('brief_text_page, text_page, date_created, date_publication', 'safe'),
			array('id_page, name_page, brief_text_page, text_page, slug_page, date_created, date_publication, user_id, status_id, sort_page, gallery_id, url, count_view', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id_page' => 'Id Page',
			'name_page' => 'Name Page',
			'brief_text_page' => 'Brief Text Page',
			'text_page' => 'Text Page',
			'slug_page' => 'Slug Page',
			'date_created' => 'Date Created',
			'date_publication' => 'Date Publication',
			'user_id' => 'User',
			'status_id' => 'Status',
			'sort_page' => 'Sort Page',
			'gallery_id' => 'Gallery',
			'url' => 'Url',
			'count_view' => 'Count View',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id_page',$this->id_page);
		$criteria->compare('name_page',$this->name_page,true);
		$criteria->compare('brief_text_page',$this->brief_text_page,true);
		$criteria->compare('text_page',$this->text_page,true);
		$criteria->compare('slug_page',$this->slug_page,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_publication',$this->date_publication,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('sort_page',$this->sort_page);
		$criteria->compare('gallery_id',$this->gallery_id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('count_view',$this->count_view);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
