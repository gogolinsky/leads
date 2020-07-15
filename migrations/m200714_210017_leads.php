<?php

use yii\db\Migration;

/**
 * Class m200714_210017_leads
 */
class m200714_210017_leads extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('leads', [
			'id' => $this->primaryKey(),
			'created_at' => $this->integer()->notNull(),
			'created_by' => $this->integer()->notNull(),
			'source_id' => $this->integer()->notNull(),
			'name' => $this->string(255)->notNull(),
			'status' => $this->string(255)->notNull(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200714_210017_leads cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200714_210017_leads cannot be reverted.\n";

        return false;
    }
    */
}
