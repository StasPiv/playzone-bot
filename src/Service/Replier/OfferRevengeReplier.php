<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 12:05
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Helper\GameReceiver;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class OfferRevengeReplier implements ReplierInterface
{
    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ) {
        GameReceiver::receiveChallenge(
            $serverMessageData,
            $botConfiguration,
            $httpRequestHandler,
            $wsRequestHandler,
            $logger
        );
    }

}