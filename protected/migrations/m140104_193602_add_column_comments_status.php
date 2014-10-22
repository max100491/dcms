<?php

class m140104_193602_add_column_comments_status extends CDbMigration
{
	public function up()
	{
		$this->addColumn('cf_comments', 'status_id', 'tinyint(1)');
	}

	public function down()
	{
		echo "m140104_193602_add_column_comments_status does not support migration down.\n";
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