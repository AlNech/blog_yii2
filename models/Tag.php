<?php

namespace app\models;

use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int|null $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function getTagPosts(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['tag_id' => 'id']);
    }

    /**
     * @return ActiveDataProvider
     */
    public function getPublishedPosts(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->getTagPosts()
                ->alias('tp')
                ->leftJoin(Post::tableName() . ' p', 'p.id = tp.post_id')
                ->where(['publish_status' => Post::STATUS_PUBLISHED])
                ->orderBy(['publish_date' => SORT_DESC])
        ]);
    }

    public static function string2array($tags)
    {
        return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(', ',$tags);
    }
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }
}
