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
            'created_at' => $this->dateTime(),


        ]);

        $this->addForeignKey('fk-posts-language_id','posts','language_id','languages','id','CASCADE');
        $this->addForeignKey('fk-posts-author_id','posts','author_id','authors','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      // $this->dropForeignKey('fk-posts-language_id','languages');
       // $this->dropForeignKey('fk-posts-author_id','authors');

        $this->dropTable('{{%posts}}');
    }
}
