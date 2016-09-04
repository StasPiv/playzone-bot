<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 1:47
 */

namespace StasPiv\PlayzoneBot\Model\BotConfiguration;


class ChallengeConfiguration
{
    /**
     * @var bool
     */
    private $sendChallengeIfUserIn = true;

    /**
     * @var array
     */
    private $challengeParamsIfUserIn = [
        'base'      => 180000,
        'increment' => 0
    ];

    /**
     * @var bool
     */
    private $receivePrivateChallenge = true;

    /**
     * @return boolean
     */
    public function isSendChallengeIfUserIn(): bool
    {
        return $this->sendChallengeIfUserIn;
    }

    /**
     * @param boolean $sendChallengeIfUserIn
     * @return ChallengeConfiguration
     */
    public function setSendChallengeIfUserIn(bool $sendChallengeIfUserIn): self
    {
        $this->sendChallengeIfUserIn = $sendChallengeIfUserIn;

        return $this;
    }

    /**
     * @return array
     */
    public function getChallengeParamsIfUserIn(): array
    {
        return $this->challengeParamsIfUserIn;
    }

    /**
     * @param array $challengeParamsIfUserIn
     * @return ChallengeConfiguration
     */
    public function setChallengeParamsIfUserIn(array $challengeParamsIfUserIn): self
    {
        $this->challengeParamsIfUserIn = $challengeParamsIfUserIn;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isReceivePrivateChallenge(): bool
    {
        return $this->receivePrivateChallenge;
    }

    /**
     * @param boolean $receivePrivateChallenge
     * @return ChallengeConfiguration
     */
    public function setReceivePrivateChallenge(bool $receivePrivateChallenge): self
    {
        $this->receivePrivateChallenge = $receivePrivateChallenge;

        return $this;
    }
}