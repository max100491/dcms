<?php
class HelperAdmin
{
    public static function getListTypeItem()
    {
        $create = Yii::app()->db->createCommand()
            ->select('*')
            ->from('cf_item_type')
            ->queryAll();
        $list = array();
        foreach($create as $item){
            $list[$item['id_type']] = $item['name_type'];
        }
        return $list;
    }
    
    public static function getListModelId()
    {
        $create = Yii::app()->db->createCommand()
            ->select('*')
            ->from('cf_models')
            ->queryAll();
        $list = array();
        foreach($create as $item){
            $list[$item['id_model']] = $item['name_model'];
        }
        return $list;
    }
}
?>