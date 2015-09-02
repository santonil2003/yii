<?php

namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Debug 
 * @package components
 * @author Sanil Shrestha <web.developer.sanil@gmail.com>
 */
class Debug extends Component {

    /**
     * extended print_r with line trace
     * @param type $data
     * @param type $label
     */
    public static function r($data, $label = '') {


        $trace = debug_backtrace();
        $html = '';
        $html.= '<p style=background:red;padding:4px;margin:0px;>';
        $html.= ' Trace : ' . $trace[0]['file'] . ', Line :';
        $html.= '<b>' . $trace[0]['line'] . '</b>';
        $html.= '</p>';
        echo $html;
        if ($label && pathinfo($label, PATHINFO_EXTENSION) != 'txt') {
            echo $label . '<hr>';
        }
        echo '<pre style="background:#e0e0e0;padding:4px;margin:0px;clear:both;">';
        print_r($data);
        echo '</pre>';
    }

    /**
     * log
     * @param type $data
     * @param type $file
     */
    public static function l($data, $file = 'log.txt') {
        $logpath = 'log';

        if (!file_exists($logpath)) {
            mkdir($logpath);
        }

        $data = (is_array($data) || is_object($data)) ? print_r($data, true) : $data;
        $prefix = date('Y') . date('m') . '_';

        try {
            $trace = debug_backtrace();
            $today = date("Y/m/d H:i:s");
            $content = "\n$today ";
            $content.=" [From " . $trace[0]['file'] . ", Line " . $trace[0]['line'] . "]";
            $content.= "\n$data";
            $fp = fopen($logpath . DIRECTORY_SEPARATOR . $prefix . $file, 'a+');
            fwrite($fp, $content);
            fclose($fp);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
