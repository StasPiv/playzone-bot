<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 12:19
 */

namespace StasPiv\PlayzoneBot\Model;

use StasPiv\ChessBestMove\Model\EngineConfiguration;
use StasPiv\ChessBestMove\Service\ChessBestMove;
use StasPiv\PlayzoneBot\Model\BotConfiguration\ChallengeConfiguration;
use JMS\Serializer\Annotation as JMS;

class BotConfiguration
{
    /**
     * @var EngineConfiguration
     *
     * @JMS\Type("StasPiv\ChessBestMove\Model\EngineConfiguration")
     */
    private $engineConfiguration;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $login;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    private $token;

    /**
     * @var ChallengeConfiguration
     *
     * @JMS\Type("StasPiv\PlayzoneBot\Model\BotConfiguration\ChallengeConfiguration")
     */
    private $challengeConfiguration;

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return BotConfiguration
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return BotConfiguration
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return EngineConfiguration
     */
    public function getEngineConfiguration(): EngineConfiguration
    {
        return $this->engineConfiguration;
    }

    /**
     * @param EngineConfiguration $engineConfiguration
     * @return BotConfiguration
     */
    public function setEngineConfiguration(EngineConfiguration $engineConfiguration): self
    {
        $this->engineConfiguration = $engineConfiguration;

        return $this;
    }

    /**
     * @return ChallengeConfiguration
     */
    public function getChallengeConfiguration(): ChallengeConfiguration
    {
        return $this->challengeConfiguration;
    }

    /**
     * @param ChallengeConfiguration $challengeConfiguration
     * @return BotConfiguration
     */
    public function setChallengeConfiguration(ChallengeConfiguration $challengeConfiguration): self
    {
        $this->challengeConfiguration = $challengeConfiguration;

        return $this;
    }
}