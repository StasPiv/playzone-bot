<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 2:12
 */

namespace StasPiv\PlayzoneBot\Helper;

use Chess\Game\ChessGame;
use Psr\Log\LoggerInterface;
use StasPiv\ChessBestMove\Service\ChessBestMove;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\Game;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSSubscribeToGame;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class GameSubscriber
{
    /**
     * @param array $rawGame
     * @param BotConfiguration $botConfiguration
     * @param HttpRequestHandler $httpRequestHandler
     * @param WSRequestHandler $wsRequestHandler
     * @param LoggerInterface $logger
     * @return Game
     */
    public static function subscribeGame(
        array $rawGame,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ): Game {
        $game = new Game($rawGame['id'], $rawGame['color'], $rawGame);

        $chessGame = new ChessGame();
        $chessGame->_parseFen(ChessBestMove::START_POSITION);

        $game->setChessGame($chessGame)
            ->setChessBestMove(new ChessBestMove($botConfiguration->getEngineConfiguration(), $logger));

        MyGamesSingleton::getGameContainer()->addGame($game);

        $wsRequestHandler->sendRequestData(
            new WSSubscribeToGame($game->getId())
        );

        self::makeMoveIfWhite($botConfiguration, $httpRequestHandler, $wsRequestHandler, $game);

        return $game;
    }

    /**
     * @param BotConfiguration $botConfiguration
     * @param HttpRequestHandler $httpRequestHandler
     * @param WSRequestHandler $wsRequestHandler
     * @param Game $game
     */
    private static function makeMoveIfWhite(
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        Game $game
    ) {
        if ($game->getMyColor() == Game::COLOR_WHITE) {
            sleep(3); // otherwise people can miss first move

            $myFirstMove = $game->getChessBestMove()->getBestMoveFromFen(ChessBestMove::START_POSITION);
            $game->addMove($myFirstMove);

            $timeWhite = (int)$game->getRawGame()['time_white'];
            $timeBlack = (int)$game->getRawGame()['time_black'];

            GameSender::sendGameThroughWs($wsRequestHandler, $game, $timeWhite, $timeBlack, $myFirstMove);

            GameSender::sendGameThroughHttp(
                $botConfiguration,
                $httpRequestHandler,
                $game,
                $timeWhite,
                $timeBlack
            );
        }
    }
}