<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:16
 */

namespace StasPiv\PlayzoneBot\Helper;

use StasPiv\PlayzoneBot\Model\Game\GameContainer;

class MyGamesSingleton
{
    /**
     * @var GameContainer
     */
    private static $gameContainer;

    /**
     * @return GameContainer
     */
    public static function getGameContainer(): GameContainer
    {
        if (!self::$gameContainer) {
            return self::$gameContainer = new GameContainer();
        }

        return self::$gameContainer;
    }
}