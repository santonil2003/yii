<?php

namespace app\components;

use yii\base\Widget;

/**
 * Description of OvcLatestVideoWidget
 *
 * @author sanil
 */
class OvcOverlayWidget extends Widget {

    public function init() {
        parent::init();
    }

    /**
     * override getViewPath
     * @return type string
     */
    public function getViewPath() {
        return \Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'widgets';
    }

    public function run() {
        return $this->render('overlay');
    }

}
