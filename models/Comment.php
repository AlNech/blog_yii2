<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

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
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    public function behaviors()
    {
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
            ['email', 'email'],
            [['content'], 'string'],
            ['url', 'url'],
            [['status', 'create_time', 'post_id'], 'integer'],
        ];
    }

    public static function findRecentComments($limit = 3)
    {
        return static::find()->where('status=' . self::STATUS_APPROVED)
            ->orderBy('create_time DESC')
            ->limit($limit)
            ->with('post')->all();
    }

    public function approve()
    {
        $this->status = Comment::STATUS_APPROVED;
        $this->update(array('status'));
    }

    public function getUrl()
    {
        return $this->url;
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
