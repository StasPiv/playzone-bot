<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 12:58
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use StasPiv\PlayzoneBot\Exception\NoUserReplierForThisServerMessageException;

class ReplierFactory
{
    /**
     * @param array $serverMessage
     * @return ReplierInterface
     */
    public static function create(array $serverMessage): ReplierInterface
    {
        $method = $serverMessage['method'];

        if (strpos($method, 'game_pgn_') !== false) {
            return new GetMoveReplier();
        }

        switch ($method) {
            case 'user_in':
                return new UserInReplier();
            case 'call_accept':
                return new CallAcceptReplier();
            case 'call_send':
                return new CallSendReplier();
            case 'offer_revenge':
                return new OfferRevengeReplier();
            default:
                throw new NoUserReplierForThisServerMessageException;
        }
    }
}