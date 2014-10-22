<?php

/**
 * This is the model class for table "cf_item_type".
 *
 * The followings are the available columns in table 'cf_item_type':
 * @property integer $id_type
 * @property string $name_type
 * @property string $action_type
 * @property integer $transmit_id
 */
class ItemType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cf_item_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_type, action_type, transmit_id', 'required'),
			array('transmit_id', 'numerical', 'integerOnly'=>true),
			array('name_type, action_type', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_type, name_type, action_type, transmit_id', 'safe', 'on'=>'search'),
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
			'id_type' => 'Id Type',
			'name_type' => 'Name Type',
			'action_type' => 'Action Type',
			'transmit_id' => 'Transmit',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('name_type',$this->name_type,true);
		$criteria->compare('action_type',$this->action_type,true);
		$criteria->compare('transmit_id',$this->transmit_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
