<?php

class m140104_180135_add_t_comments extends CDbMigration
{
	public function up()
	{
		$this->createTable('cf_comments', array(
			'id_comment'=>'pk',
			'page_id'=>'integer',
			'user_id'=>'string',
			'user_name'=>'string',
			'text_comment'=>'text',
			'date_create'=>'datetime'
		));
	}

	public function down()
	{
		echo "m140104_180135_add_t_comments does not support migration down.\n";
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