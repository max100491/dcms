<?php
Yii::import('ext.portlet.XPortlet');
class ItemsHome extends XPortlet
{
    public function renderContent()
    {
        $model = new Items;
        $this->render('_item_form', array('model'=>$model));
    }
}
?>