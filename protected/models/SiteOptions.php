<?php

/**
 * This is the model class for table "cf_site_options".
 *
 * The followings are the available columns in table 'cf_site_options':
 * @property integer $id_option
 * @property string $name_option
 * @property string $value_option
 * @property integer $model_id
 */
class SiteOptions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteOptions the static model class
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
		return 'cf_site_options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_option, value_option, model_id', 'required'),
			array('model_id', 'numerical', 'integerOnly'=>true),
			array('name_option, value_option, label_option', 'length', 'max'=>255),
			array('id_option, name_option, value_option, model_id, label_option', 'safe', 'on'=>'search'),
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
			'id_option' => '#',
			'name_option' => 'Системное имя опции',
			'value_option' => 'Значение опции',
			'model_id' => 'Модель',
            'label_option' => 'Лейбл',
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

		$criteria->compare('id_option',$this->id_option);
		$criteria->compare('name_option',$this->name_option,true);
		$criteria->compare('value_option',$this->value_option,true);
		$criteria->compare('model_id',$this->model_id);
        $criteria->compare('label_option',$this->label_option);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getListOptions($model_id, $name)
    {
        $model = self::model()->findAllByAttributes(array('model_id'=>$model_id, 'name_option'=>$name));
        return CHtml::listData($model, 'value_option', 'label_option');
    }

    public function getOptionsBul($name)
    {
    	if(isset($name)){
    		$model = self::model()->findByAttributes(array('name_option'=>$name));
    		if($model->value_option == 1){
    			return true;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }

    public function getValOptions($name)
    {
        if(isset($name)){
            return self::model()->findByAttributes(array('name_option'=>$name))->value_option;
        }
    }
}