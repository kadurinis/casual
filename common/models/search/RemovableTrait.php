<?php


namespace common\models\search;


trait RemovableTrait
{
    public function remove() {
        $this->deleted_at = time();
        $this->deleted_by = \Yii::$app->user->id;
        return $this;
    }

}