<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */


?>
<div class="post-view">
    <div class="post-view">
        <?php echo $this->context->renderPartial('_item', array(
            'post' => $post
        )); ?>


        <div id="comments" class="row-fluid">
            <?php
            if ($post->commentCount >= 1): ?>
                <h5>
                    <?php echo $post->commentCount > 1 ? $post->commentCount . ' comments' : 'One comment'; ?>
                </h5>

                <?php echo $this->context->renderPartial('_comments', array(
                    'post' => $post,
                    'comments' => $post->comments,
                )); ?>
            <?php endif; ?>

            <?php echo $this->context->renderPartial('_form', array(
                'comment' => $comment,
            )); ?>


        </div><!-- comments -->
    </div>


</div>


