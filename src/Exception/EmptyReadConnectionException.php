<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 17.09.16
 * Time: 23:22
 */

namespace StasPiv\PlayzoneBot\Exception;


use Exception;

class EmptyReadConnectionException extends \RuntimeException
{
    public function __construct($message = 'Empty read exception', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}