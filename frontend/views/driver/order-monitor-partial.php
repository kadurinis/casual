<?php
use yii\widgets\DetailView;
use common\models\search\OrderModel;
/**
 * @var \yii\web\View $this
 * @var OrderModel $model|null
 */
?>
<?php if ($model): ?>
<h3 align="center">Заявка на отгрузку №<?= $model->id ?></h3>
<div style="padding: 80pt">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created_at:datetime',
            'driverName:text',
            'foodName:text',
            'farmName:text',
            'state:text',
            'finished_at:datetime'
        ],
    ]) ?>
</div>
<?php else: ?>
<div class="alert alert-info">
    Не создано ни одной заявки. Здесь будет отображение последней заявки в реальном времени
</div>
<?php endif ?>
