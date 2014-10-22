<?php /**
* 
*/
class DownPlugin extends CFormModel
{
    public $folder;
    public $config;
    
    public function rules()
    {
        return array(
            array('folder', 'FolderValidator'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'folder'=>'Папка',
        );
    }
}?>