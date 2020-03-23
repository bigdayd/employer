<?php

use yii\db\Migration;

/**
 * Class m200322_060659_init
 */
class m200322_060659_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        //currency
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'valuteID' => $this->string(16)->notNull(),
            'numCode' => $this->smallInteger()->notNull(),
            'сharCode' => $this->string(16)->notNull(),
            'name' => $this->string(300)->notNull(),
            'value' => $this->float()->notNull(),
            'date' => $this->date()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx-currency-valuteID','currency','valuteID');
        $this->createIndex('idx-currency-date','currency','date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200322_060659_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200322_060659_init cannot be reverted.\n";

        return false;
    }
    */
}
