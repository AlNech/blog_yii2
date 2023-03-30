<?php
/** @var yii\web\View $this */
$this->title = 'My Blog';
?>
<div class="site-index">
    <h1>Добро пожаловать в мой блог!</h1>

    <?= \yii\helpers\Html::a('Перейти в ленту постов', ['/blog'], ['class' => 'btn btn-success mt-4'])?>

</div>
