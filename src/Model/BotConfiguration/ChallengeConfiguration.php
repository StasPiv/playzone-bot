<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 1:47
 */

namespace StasPiv\PlayzoneBot\Model\BotConfiguration;

use JMS\Serializer\Annotation as JMS;

class ChallengeConfiguration
{
    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     */
    private $sendChallengeIfUserIn = true;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     */
    private $sendRateChallenge = false;

    /**
     * @var ChallengeParams
     *
     * @JMS\Type("StasPiv\PlayzoneBot\Model\BotConfiguration\ChallengeParams")
     */
    private $challengeParamsIfUserIn;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
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
     * @return boolean
     */
    public function isSendRateChallenge(): bool
    {
        return $this->sendRateChallenge;
    }

    /**
     * @param boolean $sendRateChallenge
     * @return ChallengeConfiguration
     */
    public function setSendRateChallenge(bool $sendRateChallenge): self
    {
        $this->sendRateChallenge = $sendRateChallenge;

        return $this;
    }

    /**
     * @return ChallengeParams
     */
    public function getChallengeParamsIfUserIn(): ChallengeParams
    {
        return $this->challengeParamsIfUserIn;
    }

    /**
     * @param ChallengeParams $challengeParamsIfUserIn
     * @return ChallengeConfiguration
     */
    public function setChallengeParamsIfUserIn(ChallengeParams $challengeParamsIfUserIn): self
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