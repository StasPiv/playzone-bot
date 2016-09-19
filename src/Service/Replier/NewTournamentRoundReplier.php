<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 23:16
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Helper\GameSubscriber;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData\HttpGetCurrentTournamentGame;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class NewTournamentRoundReplier implements ReplierInterface
{
    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ) {
        $httpGetCurrentTournamentGame = new HttpGetCurrentTournamentGame(
            $botConfiguration->getLogin(), $botConfiguration->getToken()
        );
        $httpGetCurrentTournamentGame->setTournamentId($serverMessageData['tournament_id']);

        try {
            $rawGame = $httpRequestHandler->send($httpGetCurrentTournamentGame);
        } catch (\Exception $e) {
            return;
        }

        if (!isset($rawGame['id'])) {
            return;
        }

        GameSubscriber::subscribeGame(
            $rawGame, $botConfiguration, $httpRequestHandler, $wsRequestHandler, $logger
        );
    }

}