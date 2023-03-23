<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content
 * @property int $status
 * @property int|null $create_time
 * @property string $author
 * @property string $email
 * @property string|null $url
 * @property int $post_id
 */
class Comment extends \yii\db\ActiveRecord
{
    const STATUS_PENDING=1;
    const STATUS_APPROVED=2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }
    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time'],
                ],
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'author', 'email'], 'required'],
            [['author', 'email', 'url'], 'string', 'max' => 128],
            ['email','email'],
            [['content'], 'string'],
            ['url','url'],
            [['status', 'create_time', 'post_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Комментарий',
            'status' => 'Статус',
            'create_time' => 'Дата создания',
            'author' => 'Автор',
            'email' => 'Почта',
            'url' => 'Url',
            'post_id' => 'Post ID',
        ];
    }
}
