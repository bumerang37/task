<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180313_142550_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'language_id' => $this->integer(),
            'author_id' => $this->integer(),
            'title' => $this->string(),
            'text' => $this->text(),
            'count' => $this->integer(), //Количество лайков
            'date_create' => $this->timestamp(),

        ]);

        $this->addForeignKey('fk-posts-language_id','posts','id','languages','id','CASCADE');
        $this->addForeignKey('fk-posts-author_id','posts','id','authors','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
