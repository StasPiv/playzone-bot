<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 21:35
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use Psr\Log\LoggerInterface;
use StasPiv\ChessBestMove\Exception\BotIsFailedException;
use StasPiv\ChessBestMove\Model\Move;
use StasPiv\PlayzoneBot\Exception\GameNotFoundException;
use StasPiv\PlayzoneBot\Helper\GameSubscriber;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\Game;
use StasPiv\PlayzoneBot\Helper\GameSender;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Helper\MyGamesSingleton;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class GetMoveReplier implements ReplierInterface
{
    const LIMIT_FOR_SENDING_MOVES_TO_ENGINE = 20;

    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ) {
        $startTime = microtime(true);

        $receivedGameId = $serverMessageData['game_id'];

        try {
            $game = MyGamesSingleton::getGameContainer()->getGame($receivedGameId);
        } catch (GameNotFoundException $e) {
            $logger->error('Game #'.$receivedGameId.': '.$e->getMessage());
            return;
        }

        if (!isset($serverMessageData['move'])) {
            // some exception;
            return;
        }

        $moveArray = $serverMessageData['move'];
        $moveObject = (new Move())->setFrom($moveArray['from'])->setTo($moveArray['to']);

        if ($game->getChessGame()->isPromotionMove($moveArray)) {
            $moveObject->setPromotion($moveArray['promotion']);
        }

        $game->addMove($moveObject);

        if ($game->getChessGame()->gameOver()) {
            return;
        }

        $timeWhite = $serverMessageData['time_white'];
        $timeBlack = $serverMessageData['time_black'];

        $myMove = $this->makeMove($game, $timeWhite, $timeBlack);

        $game->addMove($myMove);

        usleep(200000);

        $endTime = microtime(true);

        $delay = 1000 * ($endTime - $startTime);

        if ($game->getMyColor() == Game::COLOR_BLACK) {
            $timeBlack -= $delay;
            $timeBlack += (int)$game->getRawGame()['game_params']['time_increment'];
        } else {
            $timeWhite -= $delay;
            $timeWhite += (int)$game->getRawGame()['game_params']['time_increment'];
        }

        GameSender::sendGameThroughWs($wsRequestHandler, $game, $timeWhite, $timeBlack, $myMove);

        GameSender::sendGameThroughHttp(
            $botConfiguration, $httpRequestHandler, $game, $timeWhite, $timeBlack
        );

        if ($game->getChessGame()->gameOver()) {
            GameSender::sendGameOverThroughWS($wsRequestHandler, $game);
        }
    }

    /**
     * @param Game $game
     * @param int $timeWhite
     * @param int $timeBlack
     * @return Move
     */
    private function makeMove(Game $game, int $timeWhite, int $timeBlack)
    {
        try {
            if (count($game->getMoves()) <= self::LIMIT_FOR_SENDING_MOVES_TO_ENGINE) {
                $myMove = $game->getChessBestMove()->getBestMoveFromMovesArray($game->getMoves(), $timeWhite, $timeBlack);

                return $myMove;
            } else {
                $myMove = $game->getChessBestMove()->getBestMoveFromFen(
                    $game->getChessGame()->renderFen(),
                    $timeWhite,
                    $timeBlack
                );

                return $myMove;
            }
        } catch (BotIsFailedException $e) {
            return $this->makeMove($game, $timeWhite, $timeBlack);
        }
    }

}