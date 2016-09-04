<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 12:32
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

interface ReplierInterface
{
    /**
     * @param array $serverMessageData
     * @param BotConfiguration $botConfiguration
     * @param HttpRequestHandler $httpRequestHandler
     * @param WSRequestHandler $wsRequestHandler
     * @param LoggerInterface $logger
     * @return
     * @internal param array $serverMessage
     */
    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    );
}