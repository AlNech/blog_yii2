<?php

namespace app\widgets;

use app\models\Tag;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class TagCloud extends Widget
{
    public $title;
    public $maxTags = 20;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'title';
        }
    }

    public function run()
    {
        $tags = Tag::findTagWeights();
        $str = '';
        foreach ($tags as $tag => $weight) {
            $link = Html::a(Html::encode($tag), 'blog/tag-search/?tags=' . $tag);
            $str .= Html::tag('span', $link, [
                    'class' => 'tag',
                    'style' => "font-size:{$weight}pt",
                ]) . "\n";
        }

        return $this->render('//blog/portal', [
            'title' => $this->title,
            'content' => $str,
        ]);
    }
}