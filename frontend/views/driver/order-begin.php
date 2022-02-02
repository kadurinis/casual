<?php

use frontend\assets\MonitorAsset;
use yii\widgets\DetailView;
use common\models\search\OrderModel;
use yii\bootstrap\Html;
/**
 * @var \yii\web\View $this
 * @var OrderModel $model|null
 */
$this->title = 'Заявка на отгрузку';
MonitorAsset::register($this);
?>
<div class="row">
    <?php \Yii::$app->session->getFlash('success') ?>
    <?php \Yii::$app->session->getFlash('error') ?>
</div>
<div id="driver-order"></div>

<div style="text-align: center; display: none" id="packing-completed" data-id="<?= $model->id ?>">
    <?= Html::a(
            'Отгрузка завершена',
            ['driver/order-finish', 'id' => $model->id],
            ['class' => 'btn btn-primary', 'style' => 'font-size: 150%']
    ) ?>
</div>