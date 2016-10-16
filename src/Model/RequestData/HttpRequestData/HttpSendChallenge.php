<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 1:31
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;

use StasPiv\PlayzoneBot\Model\BotConfiguration\ChallengeParams;

class HttpSendChallenge implements HttpSecurityRequestDataInterface
{
    use HttpSecurityRequestDataTrait;

    /**
     * @var string
     */
    private $player;

    /**
     * @var array
     */
    private $color = [];

    /**
     * @var ChallengeParams
     */
    private $time;

    /**
     * @var int
     */
    private $gamesCount = 1;

    /**
     * @var bool
     */
    private $rate = false;

    /**
     * @param string $player
     * @return HttpSendChallenge
     */
    public function setPlayer(string $player): self
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @param array $color
     * @return HttpSendChallenge
     */
    public function setColor(array $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param ChallengeParams $time
     * @return HttpSendChallenge
     */
    public function setTime(ChallengeParams $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @param int $gamesCount
     * @return HttpSendChallenge
     */
    public function setGamesCount(int $gamesCount): self
    {
        $this->gamesCount = $gamesCount;

        return $this;
    }

    /**
     * @param boolean $rate
     * @return HttpSendChallenge
     */
    public function setRate(bool $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return 'call/send';
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}