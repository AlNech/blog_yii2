<?php
use \yii\helpers\Html;
    /* @var $this \yii\web\View */
    /* @var $posts \app\models\Post */
?>

<div class="body-content">
    <?php $this->widget('TagCloud', array(
        'maxTags'=>Yii::app()->params['tagCloudCount'],
    )); ?>
    <?php foreach ($posts as $one):?>
    <div class="col-lg-12">
        <h2><?=$one->title?></h2>

        <p><?=$one->content;?></p>
        <p><?=$one->author->name?></p>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Recent Comments</h3>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <?php foreach($one->comments as $comment): ?>
                        <li><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <p class='lead'>
                                <?php echo nl2br(Html::encode($comment->content)); ?>
                            </p>
                            <?php echo $comment->url; ?> on
                            <?php echo Html::a(Html::encode($one->title), $comment->getUrl()); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>


        <?= \yii\helpers\Html::a('Подробнее', ['blog/one', 'id'=>$one->id])?>
        <?php endforeach;?>
    </div>
</div>

