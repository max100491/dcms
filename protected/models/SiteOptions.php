<?php
class SiteOptions extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'cf_site_options';
	}

	public function rules()
	{
		return array(
			array('name_option, value_option, model_id', 'required'),
			array('model_id', 'numerical', 'integerOnly'=>true),
			array('name_option, value_option, label_option', 'length', 'max'=>255),
			array('id_option, name_option, value_option, model_id, label_option', 'safe', 'on'=>'search'),
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
			'id_option' => '#',
			'name_option' => 'Системное имя опции',
			'value_option' => 'Значение опции',
			'model_id' => 'Модель',
            'label_option' => 'Лейбл',
		);
	}

	public function search()
	{
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