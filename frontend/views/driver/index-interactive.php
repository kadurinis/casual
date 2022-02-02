<?php

use common\models\OrderFood;
use common\models\search\DriverSearch;
use common\models\search\FoodSearch;
use common\models\search\FarmSearch;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use frontend\assets\DriverAsset;
/**
 * @var DriverSearch[] $drivers
 * @var FoodSearch[] $foods
 * @var FarmSearch[] $farms
 * @var \yii\web\View $this
 */
$this->title = 'Создать запрос';
DriverAsset::register($this);

?>
<div class="row">
    <?php \Yii::$app->session->getFlash('success') ?>
    <?php \Yii::$app->session->getFlash('error') ?>
</div>
<?php $form = ActiveForm::begin(['action' => ['driver/create-order']]); ?>
<div id="driver-page">
    <div id="drivers">
        <h4>Водитель</h4>
        <div class="row">
            <?php foreach ($drivers as $driver) : ?>
                <div class="col-md-3 form_radio_btn">
                    <?= Html::radio('driver_id', false, ['value' => $driver->id, 'id' => "driver{$driver->id}"]) ?>
                    <?= Html::label($driver->name, "driver{$driver->id}", ['class' => 'btn btn-primary']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php foreach (OrderFood::getSectionList() as $section) : ?>
    <div id="section<?= $section ?>" class="sections" style="display: none">
        <h3>Секция <?= $section ?></h3>
        <h4>Корм</h4>
        <div class="row">
            <?php foreach ($foods as $food) : ?>
                <div class="col-md-3 form_radio_btn">
                    <?= Html::radio("food_section_{$section}", false, ['value' => $food->id, 'id' => "section_{$section}_food_{$food->id}"]) ?>
                    <?= Html::label($food->name, "section_{$section}_food_{$food->id}", ['class' => 'btn btn-primary']) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <h4>Вес, кг</h4>
        <div class="row">
            <?php foreach (OrderFood::getWeightList() as $weight) : ?>
                <div class="col-md-3 form_radio_btn">
                    <?= Html::radio("weight_section_{$section}", false, ['value' => $weight, 'id' => "section_{$section}_weight_{$weight}"]) ?>
                    <?= Html::label($weight, "section_{$section}_weight_{$weight}", ['class' => 'btn btn-primary']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <div id="farms" style="display: none">
        <h4>Ферма</h4>
        <div class="row">
            <?php foreach ($farms as $farm) : ?>
                <div class="col-md-3 form_radio_btn">
                    <?= Html::checkbox('farm_id[]', false, ['value' => $farm->id, 'id' => "farm{$farm->id}"]) ?>
                    <?= Html::label($farm->name, "farm{$farm->id}", ['class' => 'btn btn-primary']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="preview">

    </div>

    <div class="row">
        <div class="col-md-12 form-group" style="text-align: center;margin-top:24px">
            <?= Html::button('Назад', ['id' => 'prev', 'class' => 'btn btn-primary', 'style' => 'font-size: 150%;']) ?>
            <?= Html::button('Далее', ['id' => 'next', 'class' => 'btn btn-primary', 'style' => 'font-size: 150%;']) ?>
            <?= Html::submitButton('Создать запрос', ['id' => 'submitbtn', 'class' => 'btn btn-primary', 'style' => 'font-size: 150%;']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>



