<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:07
 */

namespace StasPiv\PlayzoneBot\Model\Game;

use StasPiv\PlayzoneBot\Exception\GameNotFoundException;
use StasPiv\PlayzoneBot\Exception\NotSingleGameFoundException;
use StasPiv\PlayzoneBot\Model\Game;

class GameContainer
{
    /**
     * @var array|Game[]
     */
    private $games = [];

    /**
     * @param Game $game
     * @return $this
     */
    public function addGame(Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * @param int $id
     * @return Game
     * @throws GameNotFoundException
     * @throws NotSingleGameFoundException
     */
    public function getGame(int $id): Game
    {
        $filteredArray = array_filter(
            $this->games,
            function (Game $game) use ($id)
            {
                return $game->getId() === $id;
            }
        );

        if (empty($filteredArray)) {
            throw new GameNotFoundException;
        }

        if (count($filteredArray) > 1) {
            throw new NotSingleGameFoundException;
        }

        return $filteredArray[key($filteredArray)];
    }
}