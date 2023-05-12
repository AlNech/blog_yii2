<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Cities;

/** @var yii\web\View $this */
/** @var common\models\Reviews $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'img')->fileInput(['maxlength' => true]) ?>


    <div class="form-group mt-3">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>