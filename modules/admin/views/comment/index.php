<?php

use app\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Lookup;

/** @var yii\web\View $this */
/** @var app\models\CommentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'contentOptions'=>['style'=>'width:64px;'],
            ],
            'content:ntext',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function ($model){
                    $text=app\models\Lookup::item('CommentStatus',$model->status);
                    $url=Url::to(["comment/approve","id"=>$model->id]);
                    Url::remember();
                    return $text=='Pending Approval'?Html::a($text,$url):$text;
                },
                'contentOptions'=>['style'=>'width:136px;'],
            ],
            'create_time:datetime',
            'author',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'contentOptions'=>['style'=>'width:96px;'],
            ],
        ],
    ]); ?>


</div>
