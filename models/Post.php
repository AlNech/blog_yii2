<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $tags
 * @property int $status
 * @property int|null $create_time
 * @property int|null $update_time
 * @property int $author_id
 */
class Post extends \yii\db\ActiveRecord
{
    private $_oldTags;
    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_ARCHIVED = 3;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'author_id',
            ],
        ];
    }

    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status'], 'required'],
            ['title', 'string', 'max' => 128],
            ['status', 'in', 'range' => [1, 2, 3]],
            ['tags', 'match', 'pattern' => '/^[\w\s,]+$/',
                'message' => 'В тегах можно использовать только буквы.'],
            [['img'], 'string', 'max' => 255],
            ['tags', function ($attribute, $params) {
                $this->tags = Tag::array2string(array_unique(Tag::string2array($this->tags)));
            }],
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(['post/view',
            'id' => $this->id,
            'title' => $this->title]);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])
            ->where('status = ' . Comment::STATUS_APPROVED)
            ->orderBy('create_time DESC');
    }

    public function getCommentCount()
    {
        return $this->hasMany(Comment::className(),
            ['post_id' => 'id'])->where(['status' => Comment::STATUS_APPROVED])->count();
    }

    public function getAllCommentCount()
    {
        return $this->hasMany(Comment::className(),
            ['post_id' => 'id'])->where(['status' => Comment::STATUS_APPROVED])->count();
    }

    public function addComment($comment)
    {
        $comment->status = Comment::STATUS_APPROVED;
        $comment->post_id = $this->id;
        return $comment->save();
    }

    public function saveImage($filename)
    {
        $this->img = $filename;
        $this->save(false);
    }

    public function normalizeTags($attribute, $params)
    {
        $this->tags = Tag::array2string(array_unique(array_map('trim', Tag::string2array($this->tags))));
    }


    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // add your code here
        Tag::updateFrequency($this->_oldTags, $this->tags);
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'tags' => 'Тэг',
            'status' => 'Статус',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата обновления',
            'author_id' => 'Автор',
        ];
    }
}
