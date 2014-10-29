<?php

class GalleryTree extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'cf_gallery_tree';
	}

	public function behaviors()
	{
	    return array(
	        'nestedSetBehavior'=>array(
	            'class'=>'application.behaviors.NestedSetBehavior',
	            'leftAttribute' => 'lft',
				'rightAttribute' => 'rgt',
				'levelAttribute' => 'level',
				'hasManyRoots' => true,
	        ),
	    );
	}

	public function rules()
	{
		return array(
			// array('root, lft, rgt, level', 'required'),
			// array('root, lft, rgt, level', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations()
	{
		return array(
			'gallery'=>array(self::HAS_ONE, 'Gallery', 'id_gallery')
		);
	}
}
