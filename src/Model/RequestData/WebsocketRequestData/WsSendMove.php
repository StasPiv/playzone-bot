<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 16:15
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData;

use StasPiv\ChessBestMove\Model\Move;

class WsSendMove implements WSRequestDataInterface
{
    use WSRequestDataTrait;

    protected $dataArray = null;

    /**
     * @var int
     */
    private $gameId;

    /**
     * @var Move
     */
    private $move;

    /**
     * @var int
     */
    private $moveNumber;

    /**
     * @var int
     */
    private $timeWhite;

    /**
     * @var int
     */
    private $timeBlack;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $fen;

    public function getScope(): string
    {
        return 'send_to_game_observers';
    }

    public function getMethod(): string
    {
        return 'send_pgn_to_observers';
    }

    /**
     * @param int $gameId
     * @return WsSendMove
     */
    public function setGameId(int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * @param Move $move
     * @return WsSendMove
     */
    public function setMove(Move $move): self
    {
        $this->move = $move;

        return $this;
    }

    /**
     * @param int $moveNumber
     * @return WsSendMove
     */
    public function setMoveNumber(int $moveNumber): self
    {
        $this->moveNumber = $moveNumber;

        return $this;
    }

    /**
     * @param int $timeWhite
     * @return WsSendMove
     */
    public function setTimeWhite(int $timeWhite): self
    {
        $this->timeWhite = $timeWhite;

        return $this;
    }

    /**
     * @param int $timeBlack
     * @return WsSendMove
     */
    public function setTimeBlack(int $timeBlack): self
    {
        $this->timeBlack = $timeBlack;

        return $this;
    }

    /**
     * @param string $color
     * @return WsSendMove
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param string $fen
     * @return WsSendMove
     */
    public function setFen(string $fen): self
    {
        $this->fen = $fen;

        return $this;
    }
}