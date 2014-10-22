<?php

/**
 * This is the model class for table "cf_images".
 *
 * The followings are the available columns in table 'cf_images':
 * @property integer $id_img
 * @property integer $model_id
 * @property integer $fk_id
 * @property string $name_img
 * @property string $alt_img
 * @property integer $sort_img
 */
class UploadImagesModel extends CActiveRecord
{
    public $images;
    public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Images the static model class
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
		return 'cf_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_img', 'required'),
			array('model_id, fk_id, sort_img', 'numerical', 'integerOnly'=>true),
			array('name_img, alt_img', 'length', 'max'=>255),
            array('image', 'file', 'maxSize'=>3145728, 'types'=>'jpg, gif, png'), // 1024 * 1024 * 3  =  3 мегабайта
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_img, model_id, fk_id, name_img, alt_img, sort_img', 'safe', 'on'=>'search'),
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
			'id_img' => '#',
			'model_id' => 'Модель',
			'fk_id' => 'Внешний ключ',
			'name_img' => 'Имя изображения',
			'alt_img' => 'Описание',
			'sort_img' => 'Сортировка',
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

		$criteria->compare('id_img',$this->id_img);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('fk_id',$this->fk_id);
		$criteria->compare('name_img',$this->name_img,true);
		$criteria->compare('alt_img',$this->alt_img,true);
		$criteria->compare('sort_img',$this->sort_img);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}