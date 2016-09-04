<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:09
 */

namespace StasPiv\PlayzoneBot\Exception;

use Exception;

class GameNotFoundException extends \RuntimeException
{
    public function __construct($message = 'Game not found', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}