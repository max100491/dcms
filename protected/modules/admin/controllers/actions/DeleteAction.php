<?php

/**
* Действие удаления записей
*/
class DeleteAction extends CAction
{
    public $pk = 'id';
    public $redirectTo = 'admin';
    public $ajaxParams = 'ajax';
    public $modelClass;
    
    function run()
    {
        if (empty($_GET[$this->pk]))
            throw new CHttpException(404);

        $model = CActiveRecord::model($this->modelClass)->findByPk($_GET[$this->pk]);

        if (!$model)
            throw new CHttpException(404);

        if($model->delete() && !isset($_GET[$this->ajaxParams])){
            $this->controller->redirect(array($this->redirectTo));
        }
    }
}

?>