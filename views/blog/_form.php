<?php

use \yii\helpers\Html;
use \yii\widgets\ActiveForm;

/* @var $comment \app\controllers\BlogController */

?>

<div class="col-md-8 ">
    <div class="panel-heading">
        <h5 class="panel-title">Leave a Comment</h5>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($comment, 'author')->textInput(); ?>
        <?php echo $form->field($comment, 'email')->textInput(); ?>
        <?php echo $form->field($comment, 'url')->textInput(); ?>
        <?php echo $form->field($comment, 'content')->textArea(array('rows' => 6, 'cols' => 50)); ?>
        <div class="form-actions text-center mt-3">
            <?php echo Html::submitButton('Save', ['class' => 'btn btn-success btn-block']); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
