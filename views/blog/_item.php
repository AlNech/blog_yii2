<?php

use \yii\helpers\Html;

/* @var $post \app\controllers\BlogController */
?>
<div>

    <h1><?php echo $post->title ?></h1>

    <p class="meta">Posted by <?php echo $post->author->name . ' on ' . date('F j, Y', $post->create_time); ?></p>
    <p class='lead'>
        <?php
        echo $post->content;
        ?>
    <p>


        <!--Open img if it is existence-->
    <div class="img mt-3 mb-4">
        <?php
        if ($post->img != null) {
            echo Html::img(Yii::getAlias('@web') . '/uploads/' . $post->img,
                [
                    'alt' => 'Изображение города',
                    'style' => 'height: 300px; width:500px'

                ]);
        }
        ?>
    </div>

    <div class="mb-5">
        <p>
            <strong>Tags:</strong>
            <?php echo $post->tags; ?>
        </p>


        <?php echo Html::label("Comments ({$post->commentCount})", $post->url . '#comments'); ?> |
        Last updated on <?php echo date('F j, Y', $post->update_time); ?>
    </div>
</div>
