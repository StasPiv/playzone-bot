<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 0:51
 */

namespace StasPiv\PlayzoneBot\Exception;

class BotDontSendAnyDataException extends \RuntimeException
{
    public function __construct($message = 'Bot don\'t send any data', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}