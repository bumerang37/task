<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $language_id
 * @property int $author_id
 * @property string $title
 * @property string $text
 * @property int $count
 * @property string $date_create
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id', 'author_id', 'count'], 'integer'],
            [['text'], 'string'],
            [['date_create'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language_id' => 'Language ID',
            'author_id' => 'Author ID',
            'title' => 'Title',
            'text' => 'Text',
            'count' => 'Count',
            'date_create' => 'Date Create',
        ];
    }
}
