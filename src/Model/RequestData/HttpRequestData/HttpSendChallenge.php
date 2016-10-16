<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 1:31
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;

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
     * @var array
     */
    private $time = [];

    /**
     * @var int
     */
    private $timeBase = 180000;

    /**
     * @var int
     */
    private $timeIncrement = 1000;

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
     * @param array $time
     * @return HttpSendChallenge
     */
    public function setTime(array $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeBase(): int
    {
        return $this->timeBase;
    }

    /**
     * @param int $timeBase
     * @return HttpSendChallenge
     */
    public function setTimeBase(int $timeBase): self
    {
        $this->timeBase = $timeBase;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeIncrement(): int
    {
        return $this->timeIncrement;
    }

    /**
     * @param int $timeIncrement
     * @return HttpSendChallenge
     */
    public function setTimeIncrement(int $timeIncrement): self
    {
        $this->timeIncrement = $timeIncrement;

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