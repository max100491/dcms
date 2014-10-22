<?php

class InstallModules extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection(){
        return Yii::app()->dbinstall;
    }
 
    // возвращаем имя таблицы вместе с именем БД
    public function tableName(){
         return 'plugin';
    }

    public function attributeLabels()
    {
        return array(
            'id'=>'#',
            'name' => 'Наименование',
            'desc' => 'Описание',
            'status' => 'Статус',
            'sis_name' => 'Папка',
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('name',$this->name,true);
        $criteria->compare('desc',$this->desc,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('sis_name',$this->sis_name,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pagesize'=>20,
            ),
        ));
    }
}

?>