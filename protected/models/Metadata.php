<?php

/**
 * This is the model class for table "cf_metadata".
 *
 * The followings are the available columns in table 'cf_metadata':
 * @property integer $id_meta
 * @property integer $model_id
 * @property integer $fk_id
 * @property string $name_meta
 * @property string $title_meta
 * @property string $desc_meta
 * @property string $kay_meta
 */
class Metadata extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Metadata the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cf_metadata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id, fk_id', 'numerical', 'integerOnly'=>true),
			array('name_meta, title_meta', 'length', 'max'=>300),
			array('kay_meta', 'length', 'max'=>255),
			array('desc_meta', 'safe'),

			array('id_meta, model_id, fk_id, name_meta, title_meta, desc_meta, kay_meta', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_meta' => 'Id Meta',
			'model_id' => 'Model',
			'fk_id' => 'Fk',
			'name_meta' => 'Name Meta',
			'title_meta' => 'Title Meta',
			'desc_meta' => 'Desc Meta',
			'kay_meta' => 'Kay Meta',
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

		$criteria->compare('id_meta',$this->id_meta);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('fk_id',$this->fk_id);
		$criteria->compare('name_meta',$this->name_meta,true);
		$criteria->compare('title_meta',$this->title_meta,true);
		$criteria->compare('desc_meta',$this->desc_meta,true);
		$criteria->compare('kay_meta',$this->kay_meta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}