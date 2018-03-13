<?php

use yii\db\Migration;

/**
 * Class m180313_162803_add_authors_data
 */
class m180313_162803_add_authors_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%authors}}', ['name'], [
            ['CrazyNews'],
            ['Чук и Гек'],
            ['CatFuns'],
            ['CarDriver'],
            ['BestPics'],
            ['ЗОЖ'],
            ['Вася Пупкин'],
            ['Готовим со вкусом'],
            ['Шахтёрская Правда'],
            ['FunScience'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('{%%authors}', ['in', 'name', [
                'CrazyNews',
                'Чук и Гек',
                'CatFuns',
                'CarDriver',
                'BestPics',
                'ЗОЖ',
                'Вася Пупкин',
                'Готовим со вкусом',
                'Шахтёрская Правда',
                'FunScience']]
        )->execute();
    }


}
