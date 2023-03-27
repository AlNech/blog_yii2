<?php
    /* @var $this \yii\web\View */
    /* @var $posts \app\models\Post */
?>

<div class="body-content">
    <?php foreach ($posts as $one):?>
    <div class="col-lg-12">
        <h2><?=$one->title?></h2>

        <p><?=$one->content;?></p>
        <p><?=$one->author->name?></p>

        <p><?=$one->commentCount?></p>


        <?= \yii\helpers\Html::a('Подробнее', ['blog/one', 'id'=>$one->id])?>
        <?php endforeach;?>
    </div>
</div>

