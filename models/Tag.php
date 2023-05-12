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


    public static function findTagWeights($limit = 20)
    {
        $models = Tag::find()->orderBy(['frequency' => SORT_DESC])->all();

        $total = 0;
        foreach ($models as $model)
            $total += $model->frequency;

        $tags = [];
        if ($total > 0) {
            foreach ($models as $model)
                $tags[$model->name] = 8 + (int)(16 * $model->frequency / ($total + 10));
            ksort($tags);
        }
        return $tags;
    }

    public static function updateFrequencyOnDelete($oldTags)
    {
        $oldTags = self::string2array($oldTags);
        self::removeTags($oldTags);
    }

    public static function string2array($tags)
    {
        return preg_split('/\s*,\s*/', trim((string)$tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(',', $tags);
    }

    public static function tableName()
    {
        return 'tag';
    }

    public static function updateFrequency($oldTags, $newTags)
    {
        $oldTags = self::string2array($oldTags);
        $newTags = self::string2array($newTags);
        self::addTags(array_values(array_diff($newTags, $oldTags)));
        self::removeTags(array_values(array_diff($oldTags, $newTags)));
    }

    public static function addTags($tags)
    {
        Tag::updateAllCounters(['frequency' => 1], 'name in ("' . implode('"," ', $tags) . '")');

        foreach ($tags as $name) {
            if (!Tag::findOne(['name' => $name,])) {
                $tag = new Tag;
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            }
        }
    }

    public static function removeTags($tags)
    {
        if (empty($tags))
            return;

        Tag::updateAllCounters(['frequency' => 1], 'name in ("' . implode('"," ', $tags) . '")');
        Tag::deleteAll('frequency <= 0');
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
