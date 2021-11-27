<?php

use common\models\search\DriverSearch;
use common\models\search\FarmSearch;
use common\models\search\FoodSearch;
use yii\bootstrap\Html;
use common\models\Driver;
use common\models\Farm;
use common\models\Food;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 * @var DriverSearch $driver
 * @var FoodSearch $food
 * @var FarmSearch $farm
 */
$this->registerCss('table th:last-child {width: 2%;}');
?>
<div class="row">
    <?php \Yii::$app->session->getFlash('success') ?>
    <?php \Yii::$app->session->getFlash('error') ?>
</div>
<div class="row" style="min-height: 60vh">
    <div class="col-md-4">
        <h3>Водители</h3>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $driver->search(),
            'layout' => '{items}',
            'columns' => [
                'name:text',
                [
                    'format' => 'raw',
                    'value' => static function (Driver $driver) {
                        return Html::a(
                                Html::icon('minus'),
                                ['admin/delete-from-list', 'model' => Driver::tableName(), 'id' => $driver->id],
                                ['title' => 'Удалить', 'onClick' => 'if (!confirm("Удалить водителя?")) return false;']
                        );
                    }
                ],
            ]
        ]) ?>
    </div>
    <div class="col-md-4">
        <h3>Корм</h3>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $food->search(),
            'layout' => '{items}',
            'columns' => [
                'name:text',
                [
                    'format' => 'raw',
                    'value' => static function (Food $food) {
                        return Html::a(
                                Html::icon('minus'),
                                ['admin/delete-from-list', 'model' => Food::tableName(), 'id' => $food->id],
                                ['title' => 'Удалить', 'onClick' => 'if (!confirm("Удалить вид корма?")) return false;']
                        );
                    }
                ],
            ]
        ]) ?>
    </div>
    <div class="col-md-4">
        <h3>Ферма</h3>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $farm->search(),
            'layout' => '{items}',
            'columns' => [
                'name:text',
                [
                    'format' => 'raw',
                    'value' => static function (Farm $farm) {
                        return Html::a(
                                Html::icon('minus'),
                                ['admin/delete-from-list', 'model' => Farm::tableName(), 'id' => $farm->id],
                                ['title' => 'Удалить', 'onClick' => 'if (!confirm("Удалить ферму?")) return false;']
                        );
                    }
                ],
            ]
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div>
            <?php $form = ActiveForm::begin(['action' => ['admin/add-to-list']]); ?>

            <?= $form->field($driver, 'name')->hint('Например, Иванов А.А.') ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить водителя', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-4">
        <div>
            <?php $form = ActiveForm::begin(['action' => ['admin/add-to-list']]); ?>

            <?= $form->field($food, 'name')->hint('Например, СК-1') ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить вид корма', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-4">
        <div>
            <?php $form = ActiveForm::begin(['action' => ['admin/add-to-list']]); ?>

            <?= $form->field($farm, 'name')->hint('Например, СГЦ-1') ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить ферму', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>