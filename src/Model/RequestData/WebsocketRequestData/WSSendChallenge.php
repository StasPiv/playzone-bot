<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 13:33
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData;


class WSSendChallenge implements WSRequestDataInterface
{
    use WSRequestDataTrait;

    public function getScope(): string
    {
        return 'send_to_users';
    }

    public function getMethod(): string
    {
        return 'call_send';
    }
}