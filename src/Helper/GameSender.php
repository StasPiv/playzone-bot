<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 1:28
 */

namespace StasPiv\PlayzoneBot\Helper;

use StasPiv\ChessBestMove\Model\Move;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\Game;
use StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData\HttpPutGame;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WsSendMove;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class GameSender
{
    /**
     * @param WSRequestHandler $wsRequestHandler
     * @param Game             $game
     */
    public static function sendGameOverThroughWS(WSRequestHandler $wsRequestHandler, Game $game)
    {
        $wsRequestHandler->sendRequestData(
            (new WsSendMove())->setGameId($game->getId())
        );
    }

    /**
     * @param BotConfiguration $botConfiguration
     * @param HttpRequestHandler $httpRequestHandler
     * @param Game $game
     * @param int $timeWhite
     * @param int $timeBlack
     */
    public static function sendGameThroughHttp(
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        Game $game,
        int $timeWhite,
        int $timeBlack
    ) {
        $httpRequest = new HttpPutGame($botConfiguration->getLogin(), $botConfiguration->getToken());
        $httpRequest->setGameId($game->getId())
            ->setFen($game->getChessGame()->renderFen())
            ->setPgn(base64_encode($game->getChessGame()->getPgn()))
            ->setTimeWhite($timeWhite)
            ->setTimeBlack($timeBlack)
            ->setCurrentMove(count($game->getMoves()));

        $httpRequestHandler->send($httpRequest);
    }

    /**
     * @param WSRequestHandler $wsRequestHandler
     * @param Game             $game
     * @param int              $timeWhite
     * @param int              $timeBlack
     * @param Move             $myMove
     */
    public static function sendGameThroughWs(
        WSRequestHandler $wsRequestHandler,
        Game $game,
        int $timeWhite,
        int $timeBlack,
        Move $myMove
    ) {
        $wsRequestHandler->sendRequestData(
            (new WsSendMove())->setGameId($game->getId())
                ->setColor(
                    $game->getMyColor() == Game::COLOR_BLACK ? Game::COLOR_WHITE : Game::COLOR_WHITE
                )
                ->setTimeWhite($timeWhite)
                ->setTimeBlack($timeBlack)
                ->setFen($game->getChessGame()->renderFen())
                ->setMove($myMove)
                ->setMoveNumber(count($game->getMoves()))
        );
    }
}