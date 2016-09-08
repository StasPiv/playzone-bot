<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 08.09.16
 * Time: 20:47
 */

use StasPiv\PlayzoneBot\Service\RunService;

require_once '../vendor/autoload.php';

RunService::run($argv[1]);