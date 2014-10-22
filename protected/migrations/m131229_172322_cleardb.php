<?php

class m131229_172322_cleardb extends CDbMigration
{
	public function up()
	{

		$this->truncateTable('cf_pages');
		$this->truncateTable('cf_items');
		$this->truncateTable('cf_gallery');
		$this->truncateTable('cf_images');
		$this->truncateTable('cf_menu');
		$this->truncateTable('cf_attrubutes');
		$this->truncateTable('cf_attr_page');
		$this->truncateTable('cf_feedback');
		$this->truncateTable('cf_metadata');
		$this->truncateTable('cf_page_item');
	}

	public function down()
	{
		echo "m131229_172322_cleardb does not support migration down.\n";
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