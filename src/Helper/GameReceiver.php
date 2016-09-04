<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 12:03
 */

namespace StasPiv\PlayzoneBot\Helper;


use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData\HttpCallAccept;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSReceiveChallenge;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class GameReceiver
{
    /**
     * @param array $challenge
     * @param BotConfiguration $botConfiguration
     * @param HttpRequestHandler $httpRequestHandler
     * @param WSRequestHandler $wsRequestHandler
     * @param LoggerInterface $logger
     */
    public static function receiveChallenge(
        array $challenge,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ) {
        $receivedToUser = $challenge['to_user'];

        if ($receivedToUser['login'] != $botConfiguration->getLogin()) {
            return;
        }

        $httpCallAcceptRequest = new HttpCallAccept($botConfiguration->getLogin(), $botConfiguration->getToken());
        $httpCallAcceptRequest->setCallId($challenge['id']);

        $rawGame = $httpRequestHandler->send($httpCallAcceptRequest);

        GameSubscriber::subscribeGame(
            $rawGame,
            $botConfiguration,
            $httpRequestHandler,
            $wsRequestHandler,
            $logger
        );

        $wsRequestHandler->sendRequestData(
            (new WSReceiveChallenge())->setDataArray(
                [
                    'game' => $rawGame,
                    'call_id' => $challenge['id'],
                    'game_id' => $rawGame['id']
                ]
            )
        );
    }

}