<?php

use app\widgets\TagCloud;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $posts \app\models\Post */
?>

<div class="body-content">
    <div class="col-md-5 border border-dark p-2">
        <p>Tags:</p>
        <?= TagCloud::widget([
            'title' => '<i class="icon-st"></i>',
            'maxTags' => 5,
        ]) ?>
    </div>

    <?php foreach ($posts as $one): ?>
    <div class="col-lg-12">
        <h2><?= $one->title ?></h2>

        <p><?= $one->content; ?></p>
        <p>Автор: <?= $one->author->name ?>  </p>
        <?= \yii\helpers\Html::a('Перейти в статью', ['blog/one', 'id' => $one->id], ['class' => 'btn btn-warning']) ?>
        <div class="panel panel-default border border-yellow p-3 mt-3">
            <div class="panel-heading">
                <h6 class="panel-title">Последние комментарии</h6>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <?php foreach ($one->comments as $comment): ?>
                        <li><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <p class='lead'>
                                <?php echo nl2br(Html::encode($comment->content)); ?>
                            </p>
                            <?php echo $comment->author; ?> on
                            <?php echo Html::a(Html::encode($one->title), $comment->getUrl()); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>


        <?php endforeach; ?>
    </div>
</div>

