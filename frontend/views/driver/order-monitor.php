<?php
use frontend\assets\MonitorAsset;
/**
 * @var \yii\web\View $this
 */
MonitorAsset::register($this);
$this->title = 'Мониторинг';
?>
<div id="monitor-order"></div>
<div style="text-align: center">
    <button id="process-order" style="display: none" class="btn btn-primary">Принято, отгружаем</button>
</div>
<div id="new-order">Новая заявка!</div>