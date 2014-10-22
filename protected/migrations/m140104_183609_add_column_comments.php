<?php

class m140104_183609_add_column_comments extends CDbMigration
{
	public function up()
	{
		$this->addColumn('cf_comments', 'model_id', 'tinyint(1)');
	}

	public function down()
	{
		echo "m140104_183609_add_column_comments does not support migration down.\n";
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