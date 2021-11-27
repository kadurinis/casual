<?php


namespace common\models\graber;


use yii\base\Model;

class AlawarXmlUrl extends Model
{
    const RU = 'ru';
    const PID = 20699;

    private $_url = 'http://export.alawar.ru/games_agsn_xml.php?pid=#PID#&lang=#LANG#';
    private $_pid;
    private $_lang;

    public function setPid($id) {
        $this->_pid = $id;
        return $this;
    }

    public function getPid() {
        return $this->_pid ?: self::PID;
    }

    public function setLang($code) {
        $this->_lang = $code;
        return $this;
    }

    public function getLang() {
        return $this->_lang ?: self::RU;
    }

    public function getUrl() {
        return str_replace(['#PID#', '#LANG#'], [$this->getPid(), $this->getLang()], $this->_url);
    }
}