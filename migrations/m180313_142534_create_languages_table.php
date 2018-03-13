<?php

use yii\db\Migration;

/**
 * Handles the creation of table `languages`.
 */
class m180313_142534_create_languages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%languages}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%languages}}');
    }
}
