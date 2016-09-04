<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 0:58
 */

namespace StasPiv\PlayzoneBot\Exception;

class CanNotResolveServerMessageException extends \RuntimeException
{
    public function __construct($message = 'Can not resolve server message', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}