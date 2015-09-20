<?php

namespace app\components;

use yii\base\Widget;

/**
 * Description of OvcLatestVideoWidget
 *
 * @author sanil
 */
class OvcVideoPlayerWidget extends Widget {

    public $path;
    public $cssClass = '';
    public $controls = true;
    public $startTime = '#t=00:00:00';

    public function init() {
        parent::init();

        if ($this->controls) {
            $this->controls = 'controls';
        } else {
            $this->controls = '';
        }
    }

    /**
     * override getViewPath
     * @return type string
     */
    public function getViewPath() {
        return \Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'widgets';
    }

    public function run() {

        $ext = pathinfo($this->path, PATHINFO_EXTENSION);

        switch ($ext) {
            case 'mp4':
            case 'm4v':
                $type = 'video/mp4';
                break;
            case 'webm':
                $type = 'video/webm';
                break;
            case 'ovg':
                $type = 'video/ogg';
                break;
            case '3gp':
                $type = 'video/3gp';
                break;
            default:
                $type = '';
                break;
        }


        return $this->render('video_player', ['startTime' => $this->startTime, 'controls' => $this->controls, 'path' => $this->path, 'type' => $type, 'cssClass' => $this->cssClass]);
    }

}
