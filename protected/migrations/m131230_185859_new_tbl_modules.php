<?php

class m131230_185859_new_tbl_modules extends CDbMigration
{
	public function up()
	{
		$this->createTable('cf_modules', array(
			'id_mod'=>'pk',
			'sis_name_mod'=>'string',
			'name_mod'=>'string',
			'desc_mod'=>'text',
			'status_mod'=>'integer'
		));
	}

	public function down()
	{
		echo "m131230_185859_new_tbl_modules does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}