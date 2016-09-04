<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 11:46
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData;


class WSReceiveChallenge implements WSRequestDataInterface
{
    use WSRequestDataTrait;

    public function getScope(): string
    {
        return 'send_to_users';
    }

    public function getMethod(): string
    {
        return 'call_accept';
    }
}