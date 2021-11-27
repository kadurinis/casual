<?php
namespace common\models\graber;

class AlawarXmlReader extends \yii\base\Model
{
    private $_conf;

    public function setConfig(AlawarXmlUrl $conf) {
        $this->_conf = $conf;
        return $this;
    }

    public function execute() {
        $answer = file_get_contents($this->_conf->getUrl());
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $this->_conf->getUrl(),
            CURLOPT_TIMEOUT => 60,
        ]);
        $response = curl_exec($curl);
        if ((int)curl_getinfo($curl, CURLINFO_RESPONSE_CODE) === 200) {

            return false;
        }
        curl_close($curl);
    }
}