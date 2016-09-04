<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 12:32
 */

namespace StasPiv\PlayzoneBot\Service\Replier;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\Game;
use StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData\HttpSendChallenge;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSSendChallenge;
use StasPiv\PlayzoneBot\Service\HttpRequestHandler;
use StasPiv\PlayzoneBot\Service\WSRequestHandler;

class UserInReplier implements ReplierInterface
{
    public function reply(
        array $serverMessageData,
        BotConfiguration $botConfiguration,
        HttpRequestHandler $httpRequestHandler,
        WSRequestHandler $wsRequestHandler,
        LoggerInterface $logger
    )
    {
        if (!$botConfiguration->getChallengeConfiguration()->isSendChallengeIfUserIn()) {
            return;
        }

        $sendChallengeRequest = new HttpSendChallenge(
            $botConfiguration->getLogin(),
            $botConfiguration->getToken()
        );

        $sendChallengeRequest->setPlayer($serverMessageData['login'])
            ->setTime($botConfiguration->getChallengeConfiguration()->getChallengeParamsIfUserIn());

        $challengeResponse = $httpRequestHandler->send($sendChallengeRequest);

        $wsSendChallenge = new WSSendChallenge();

        $wsSendChallenge->setDataArray($challengeResponse);

        $wsRequestHandler->sendRequestData($wsSendChallenge);

    }

}