<?php

use \yii\helpers\Html;

/* @var $post \app\controllers\BlogController */
/* @var $comments \app\controllers\BlogController */


foreach ($comments as $comment): ?>
    <div class="well" id="c<?php echo $comment->id; ?>">
        <div class="row">
            <div class="col-md-7 border border-success">
                <strong class="h5"><?php echo $comment->author; ?>
                    <span>
                        <?php echo Html::a("link #{$comment->id}", $comment->getUrl(), [
                            'class' => 'cid',
                            'title' => 'Permalink to this comment!',
                        ]); ?>

                    </span>
                </strong>

                <p><?php echo date('F j, Y \a\t h:i a', $comment->create_time);
                    echo '   ' . $comment->email; ?> </p>
                <hr style="margin:2px 0px;">
                <p class='lead'>
                    <?php echo nl2br(Html::encode($comment->content)); ?>
                </p>
            </div>

        </div>

        <h5>

        </h5>
    </div><!-- comment -->
<?php endforeach; ?>
