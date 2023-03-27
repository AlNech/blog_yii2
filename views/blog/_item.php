<?php
use \yii\helpers\Html;
?>
<div>

    <h1><?php echo Html::a(Html::encode($post->title), $post->url); ?></h1>

    <p class="meta">Posted by <?php echo $post->author->name . ' on ' . date('F j, Y',$post->create_time); ?></p>
    <p class='lead'>
        <?php
        echo $post->content;
        ?>
    <p>
    <div>
        <p>
            <strong>Tags:</strong>
            <?php echo  $post->tags; ?>
        </p>
        <?php echo Html::a('Permalink', $post->url); ?> |
        <?php echo Html::a("Comments ({$post->commentCount})",$post->url.'#comments'); ?> |
        Last updated on <?php echo date('F j, Y',$post->update_time); ?>
    </div>
</div>
