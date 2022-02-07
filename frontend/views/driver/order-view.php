<?php
use yii\widgets\DetailView;
use common\models\search\OrderModel;
use yii\bootstrap\Html;
/**
 * @var \yii\web\View $this
 * @var OrderModel $model|null
 */
$this->title = 'Заявка ' . ($model ? $model->id : '');
?>
<div class="row">
    <?php \Yii::$app->session->getFlash('success') ?>
    <?php \Yii::$app->session->getFlash('error') ?>
</div>
<?php if ($model): ?>
    <h3 align="center">Заявка на отгрузку №<?= $model->id ?></h3>
    <div style="padding: 80pt">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'created_at:datetime',
                'driverName:text',
                'truckName:text',
                'foodList:html',
                'farmList:text',
                'state:text',
                'finished_at:datetime'
            ],
        ]) ?>
    </div>
    <div style="text-align: center">
        <?= Html::a(
            'Выход',
            ['driver/index'],
            ['class' => 'btn btn-primary', 'style' => 'font-size: 150%']
        ) ?>
    </div>
<?php endif ?>