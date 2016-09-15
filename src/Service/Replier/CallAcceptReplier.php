<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 13:39
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Exception\GameNotFoundException;
use StasPiv\PlayzoneBot\Helper\GameSubscriber;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData\HttpGetGame;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Helper\MyGamesSingleton;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class CallAcceptReplier implements ReplierInterface
{
    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ) {
        $gameId = $serverMessageData['game']['id'];

        if (!$serverMessageData['game']['mine']) {
            return;
        }

        try {
            MyGamesSingleton::getGameContainer()->getGame($gameId);
            $logger->error('Already subscribed on game #'.$gameId);
            return;
        } catch (GameNotFoundException $e) {
            $rawGame = $httpRequestHandler->send(
                (new HttpGetGame(
                    $botConfiguration->getLogin(),
                    $botConfiguration->getToken()
                ))->setGameId($gameId)
            );

            GameSubscriber::subscribeGame(
                $rawGame,
                $botConfiguration,
                $httpRequestHandler,
                $wsRequestHandler,
                $logger
            );
        }
    }
}