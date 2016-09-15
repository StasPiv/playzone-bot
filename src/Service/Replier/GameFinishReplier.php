<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 14.09.16
 * Time: 23:03
 */

namespace StasPiv\PlayzoneBot\Service\Replier;


use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Exception\GameNotFoundException;
use StasPiv\PlayzoneBot\Helper\MyGamesSingleton;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class GameFinishReplier implements ReplierInterface
{
    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ) {
        if (!isset($serverMessageData['game_id'])) {
            $logger->error('For some reason game has been finished without id');
        }

        $finishedGameId = $serverMessageData['game_id'];

        try {
            $game = MyGamesSingleton::getGameContainer()->getGame($finishedGameId);
        } catch (GameNotFoundException $e) {
            return;
        }

        $game->getChessBestMove()->shutDown();
    }

}