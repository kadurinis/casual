<?php

use common\models\search\OrderHistory;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\select2\Select2;
/**
 * @var \yii\web\View $this
 * @var OrderHistory $model
 */

$this->title = 'История заявок';
$columns = [
    [
        'attribute' => 'created_at',
        'format' => 'datetime',
        'filterType' => GridView::FILTER_DATE,
    ],
    [
        'attribute' => 'finished_at',
        'format' => 'datetime',
        'filterType' => GridView::FILTER_DATE,
    ],
    [
        'class' => DataColumn::class,
        'attribute' => 'driver_id',
        'filter' => $model->getDriverList(),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => [
                'placeholder' => '',
                'allowClear' => true,
                'dropdownAutoWidth' => true,
            ]
        ],
        'format' => ['ExistInArray', $model->getDriverList()],
    ],
    [
        'class' => DataColumn::class,
        'attribute' => 'truck_id',
        'filter' => $model->getTruckList(),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => [
                'placeholder' => '',
                'allowClear' => true,
                'dropdownAutoWidth' => true,
            ]
        ],
        'format' => ['ExistInArray', $model->getTruckList()],
    ],
    [
        'class' => DataColumn::class,
        'attribute' => 'food_id',
        'filter' => $model->getFoodList(),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => [
                'placeholder' => '',
                'allowClear' => true,
                'dropdownAutoWidth' => true,
            ]
        ],
        //'format' => ['ExistInArray', $model->getFoodList()],
        'format' => 'text',
        'value' => static function (OrderHistory $model) {
            return $model->getFoodCell();
        }
    ],
    [
        'class' => DataColumn::class,
        'attribute' => 'farm_id',
        'filter' => $model->getFarmList(),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => [
                'placeholder' => '',
                'allowClear' => true,
                'dropdownAutoWidth' => true,
            ]
        ],
        //'format' => ['ExistInArray', $model->getFarmList()],
        'format' => 'text',
        'value' => static function (OrderHistory $model) {
            return $model->getFarmCell();
        }
    ],
];
$dataProvider = $model->search();
?>
<div class="row">
    <div class="col-md-4">
        <h3>История заявок</h3>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div style="float: right">
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $columns,
            'dropdownOptions' => [
                'label' => 'Export All',
                'class' => 'btn btn-secondary',
            ],
        ])
        ?>
        </div>
    </div>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'resizableColumns' => false,
    'pjax' => true,
    'pjaxSettings' => [
        'options' => ['id' => 'history-pjax', 'timeout' => 3000]
    ],
    'columns' => $columns,
]) ?>
