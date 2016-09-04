<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 1:11
 */

namespace StasPiv\PlayzoneBot\Service;


use Psr\Log\AbstractLogger;

class EchoLogger extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        echo strtoupper($level).': '.$message.PHP_EOL;
    }

}