<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 1:11
 */

namespace StasPiv\PlayzoneBot\Logger;

use Psr\Log\AbstractLogger;

class BotLogger extends AbstractLogger implements BotLoggerInterface
{
    /**
     * @var string
     */
    private $logFileName;

    /**
     * @var string
     */
    private $botName;

    /**
     * EchoLogger constructor.
     * @param string $logFileName
     * @param string $botName
     */
    public function __construct(string $logFileName, string $botName)
    {
        $this->logFileName = $logFileName;
        $this->botName = $botName;
    }

    public function log($level, $message, array $context = array())
    {
        file_put_contents(
            $this->logFileName.'.'.$level, '['.date('Y-m-d H:i:s').'] ('.$this->getBotName().') '.$message.PHP_EOL, FILE_APPEND
        );
    }

    /**
     * @return string
     */
    public function getBotName(): string
    {
        return $this->botName;
    }
}