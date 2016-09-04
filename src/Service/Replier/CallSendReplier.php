<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 2:11
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Helper\GameReceiver;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class CallSendReplier implements ReplierInterface
{
    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    ) {
        if (!$botConfiguration->getChallengeConfiguration()->isReceivePrivateChallenge()) {
            return;
        }

        $privateChallengesToMe = array_filter(
            $serverMessageData,
            function(array $challenge) use ($botConfiguration)
            {
                return $challenge['from_user']['login'] != $botConfiguration->getLogin() &&
                       isset($challenge['to_user']) &&
                       $challenge['to_user']['login'] == $botConfiguration->getLogin();
            }
        );

        if (empty($privateChallengesToMe)) {
            return;
        }

        GameReceiver::receiveChallenge(
            $privateChallengesToMe[key($privateChallengesToMe)],
            $botConfiguration,
            $httpRequestHandler,
            $wsRequestHandler,
            $logger
        );
    }
}