<?php
class Menu extends CActiveRecord
{
    public $folder_gallery = 'menu';

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'cf_menu';
	}

    public function behaviors(){
        return array( 'EAdvancedArBehavior' => array(
            'class' => 'application.behaviors.EAdvancedArBehavior'));
    }

	public function rules()
	{
		return array(
			array('name_menu', 'length', 'max'=>255),
			array('id_menu, name_menu', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
            'items' => array(self::MANY_MANY, 'Items', 'cf_menu_items(menu_id, item_id)', 'condition'=>'status_id = 2'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id_menu' => '#',
			'name_menu' => 'Наименование',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id_menu',$this->id_menu);
		$criteria->compare('name_menu',$this->name_menu,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getList()
    {
        $model = self::model()->findAll();
        return CHtml::listData($model, 'id_menu', 'name_menu');
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