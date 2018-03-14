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
 * @property string $created_at
 *
 * @property Authors $author
 * @property Languages $language
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id', 'author_id', 'count'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'default', 'value'=> date('Y-m-d H:i:s')],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language_id' => 'Language ',
            'author_id' => 'Author ',
            'title' => 'Title',
            'text' => 'Text',
            'count' => 'Count',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }
}
