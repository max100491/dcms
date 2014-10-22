<?php

/**
* Валидатор папок
*/
class FolderValidator extends CValidator
{
    public $path = null;

    public function init()
    {
        $this->path = Yii::getPathOfAlias('application').'/modules/';
    }

    protected function validateAttribute($object,$attribute)
    {
        // Если атрибут path не установлен, устанавлевает его поумолчанию, запуская функцию init()
        if($this->path===null){
            $this->init();
        }

        // Проверяет существует ли папка.
        $this->isFolder($object);

        // Проверяет права, можно ли удалить папку
        $this->isDellFolder($object);
        return $object;
    }

    /**
    * Проверяет существует ли папка по заданному пути
    */
    protected function isFolder($object)
    {
        foreach($object->attributes as $attribute){
            if(!file_exists($this->path.$attribute)){
                $this->addError($object, $attribute, "{$attribute}, не существует, {$this->path}{$attribute} папка не найдена");
            }
        }
    }

    protected function isDellFolder($object)
    {
        foreach($object->attributes as $attribute){
            if(!is_writable($this->path.$attribute)){
                $this->addError($object, $attribute, "Невозможно удалить папку {$attribute}, недостаночно прав");
            }
        }
    }
}
?>