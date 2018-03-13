<?php

use yii\db\Migration;

/**
 * Class m180313_162032_add_languages_data
 */
class m180313_162032_add_languages_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%languages}}', ['title'], [
            ['title' => 'Русский'],
            ['title' => 'English']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('{{%authors}}', ['in', 'name', [
                'Русский',
                'English']]
        )->execute();
    }


}
