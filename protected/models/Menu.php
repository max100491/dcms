<?php

class Menu extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'cf_menu';
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
			'id_menu' => 'Id Menu',
			'name_menu' => 'Name Menu',
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

	/**
     * Получить пункты меню по id меню. 
     */
    public function getItemMenuId($id, $order = 'sort_item ASC')
    {
        $model = self::model()->findByPk($id);
        $items = array();
        foreach($model->items(array('order'=>$order)) as $item){
            switch ($item->type->transmit_id) {
                case 0: $url = array($item->type->action_type);
                    break;
                case 1: $url = (!empty($item->pages) || $item->type->action_type!='/pages/index') ? array($item->type->action_type, 'id'=>$item->id_item) : '#';
                    break;
                case 2: $url = Yii::app()->homeUrl;
                    break;
            }
            $items[] = array(
                'label'=>$item->name_item,
                'url'=>$url,
                'items'=>$this->getItemNested($item->id_item)
            );
        }
        return $items;
    }

    public function getItemNested($id, $order = 'sort_item ASC')
    {
        $model = Items::model()->findAllByAttributes(array('parent_id'=>$id, 'status_id'=>2));
        if($model){
            $items = array();
            foreach($model as $item){
                switch ($item->type->transmit_id) {
                    case 0: $url = array($item->type->action_type);
                        break;
                    case 1: $url = array($item->type->action_type, 'id'=>$item->id_item);
                        break;
                    case 2: $url = Yii::app()->homeUrl;
                        break;
                }
                $items[] = array(
                    'label'=>$item->name_item,
                    'url'=>$url,
                );
            }
            return $items;
        }
    }
	
}
