<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 12:45
 */

namespace StasPiv\PlayzoneBot\Model\ServerConfiguration;

use StasPiv\PlayzoneBot\Model\ServerConfiguration;

class TestServerConfiguration extends ServerConfiguration
{
    /**
     * @var string
     */
    protected $wsServerUrl = 'ws://ws.playzone-angular.lc:8081/';

    /**
     * @var string
     */
    protected $apiUrl = 'http://api.playzone-angular.lc/app_dev.php/';
}