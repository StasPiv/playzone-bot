<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 22:28
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;

class HttpPutGame implements HttpSecurityRequestDataInterface
{
    use HttpSecurityRequestDataTrait;

    /**
     * @var int
     */
    private $gameId;

    /**
     * @var string
     */
    private $pgn;

    /**
     * @var string
     */
    private $fen;

    /**
     * @var int
     */
    private $timeWhite;

    /**
     * @var int
     */
    private $timeBlack;

    /**
     * @var int
     */
    private $currentMove = 0;

    public function getUrl(): string
    {
        return 'game/'.$this->getGameId().'/pgn';
    }

    public function getMethod(): string
    {
        return 'PUT';
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * @param int $gameId
     * @return HttpPutGame
     */
    public function setGameId(int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * @return string
     */
    public function getPgn(): string
    {
        return $this->pgn;
    }

    /**
     * @param string $pgn
     * @return HttpPutGame
     */
    public function setPgn(string $pgn): self
    {
        $this->pgn = $pgn;

        return $this;
    }

    /**
     * @return string
     */
    public function getFen(): string
    {
        return $this->fen;
    }

    /**
     * @param string $fen
     * @return HttpPutGame
     */
    public function setFen(string $fen): self
    {
        $this->fen = $fen;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeWhite(): int
    {
        return $this->timeWhite;
    }

    /**
     * @param int $timeWhite
     * @return HttpPutGame
     */
    public function setTimeWhite(int $timeWhite): self
    {
        $this->timeWhite = $timeWhite;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeBlack(): int
    {
        return $this->timeBlack;
    }

    /**
     * @param int $timeBlack
     * @return HttpPutGame
     */
    public function setTimeBlack(int $timeBlack): self
    {
        $this->timeBlack = $timeBlack;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentMove(): int
    {
        return $this->currentMove;
    }

    /**
     * @param int $currentMove
     * @return HttpPutGame
     */
    public function setCurrentMove(int $currentMove): self
    {
        $this->currentMove = $currentMove;

        return $this;
    }

}