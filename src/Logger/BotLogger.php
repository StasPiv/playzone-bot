<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 1:11
 */

namespace StasPiv\PlayzoneBot\Logger;

use Psr\Log\AbstractLogger;

class BotLogger extends AbstractLogger
{
    /**
     * @var string
     */
    private $logFileName;

    /**
     * EchoLogger constructor.
     * @param string $logFileName
     */
    public function __construct($logFileName)
    {
        $this->logFileName = $logFileName;
    }

    public function log($level, $message, array $context = array())
    {
        file_put_contents(
            $this->logFileName.'.'.$level, '['.date('y-m-d H:i:s').'] '.$message.PHP_EOL, FILE_APPEND
        );
    }
}