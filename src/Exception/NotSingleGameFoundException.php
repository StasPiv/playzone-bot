<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:12
 */

namespace StasPiv\PlayzoneBot\Exception;

use Exception;

class NotSingleGameFoundException extends \RuntimeException
{
    public function __construct($message = 'Not single game found', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}