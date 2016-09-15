<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 16.09.16
 * Time: 0:04
 */

namespace StasPiv\PlayzoneBot\Logger;

use Psr\Log\LoggerInterface;

interface BotLoggerInterface extends LoggerInterface
{
    /**
     * @return string
     */
    public function getBotName(): string ;
}