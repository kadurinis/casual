<?php
use yii\bootstrap\Html;

/**
 * @var \yii\web\View $this
 */
$this->registerCss('.admin-btn {margin: 25px; width: 100%; padding: 20px; font-size: 240%}');
$this->title = 'Панель администратора';
?>
<div class="row" style="padding: 10vh 0">
    <div class="col-md-2 col-xs-0"></div>
    <div class="col-md-8 col-xs-12">
        <div class="row">
            <?= Html::a('Редактирование списков', ['admin/lists'], ['class' => 'btn btn-primary admin-btn']) ?>
        </div>
        <div class="row">
            <?= Html::a('История заявок', ['admin/orders'], ['class' => 'btn btn-primary admin-btn']) ?>
        </div>
        <div class="row">
            <?= Html::a('Выход в главное меню', ['/'], ['class' => 'btn btn-primary admin-btn']) ?>
        </div>
    </div>
    <div class="col-md-2 col-xs-0"></div>
</div>

