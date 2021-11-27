<?php


namespace common\models;


class Formatter extends \yii\i18n\Formatter
{
    public function asExistInArray($value, $options = [])
    {
        if (isset($options[$value])) {
            return $options[$value];
        }

        return $value;
    }
}