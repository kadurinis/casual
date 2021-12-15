<?php
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

    <div id="foods">
        <h4>Корм</h4>
        <div class="row">
            <?php foreach ($foods as $food) : ?>
                <div class="col-md-3 form_radio_btn">
                    <?= Html::checkbox('food_id[]', false, ['value' => $food->id, 'id' => "food{$food->id}"]) ?>
                    <?= Html::label($food->name, "food{$food->id}", ['class' => 'btn btn-primary']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="farms">
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



