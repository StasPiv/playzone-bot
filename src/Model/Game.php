<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:05
 */

namespace StasPiv\PlayzoneBot\Model;

use Chess\Game\ChessGame;
use StasPiv\ChessBestMove\Model\Move;
use StasPiv\ChessBestMove\Service\ChessBestMove;

class Game
{
    const COLOR_WHITE = 'w';

    const COLOR_BLACK = 'b';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $pgn;

    /**
     * @var string
     */
    private $myColor;

    /**
     * @var array
     */
    private $rawGame;

    /**
     * @var ChessGame
     */
    private $chessGame;

    /**
     * @var ChessBestMove
     */
    private $chessBestMove;

    /**
     * @var array
     */
    private $moves;

    /**
     * Game constructor.
     * @param int $id
     * @param string $myColor
     * @param array $rawGame
     */
    public function __construct(int $id, string $myColor, array $rawGame)
    {
        $this->id = $id;
        $this->myColor = $myColor;
        $this->rawGame = $rawGame;
        $this->chessGame = new ChessGame();
    }

    /**
     * @param string $pgn
     * @return Game
     */
    public function setPgn(string $pgn): self
    {
        $this->pgn = $pgn;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPgn(): string
    {
        return $this->pgn;
    }

    /**
     * @return string
     */
    public function getMyColor(): string
    {
        return $this->myColor;
    }

    /**
     * @return array
     */
    public function getRawGame(): array
    {
        return $this->rawGame;
    }

    /**
     * @return ChessGame
     */
    public function getChessGame(): ChessGame
    {
        return $this->chessGame;
    }

    /**
     * @param ChessGame $chessGame
     * @return Game
     */
    public function setChessGame(ChessGame $chessGame): self
    {
        $this->chessGame = $chessGame;

        return $this;
    }

    /**
     * @return ChessBestMove
     */
    public function getChessBestMove(): ChessBestMove
    {
        return $this->chessBestMove;
    }

    /**
     * @param ChessBestMove $chessBestMove
     * @return Game
     */
    public function setChessBestMove(ChessBestMove $chessBestMove): self
    {
        $this->chessBestMove = $chessBestMove;

        return $this;
    }

    /**
     * @param Move $move
     * @return Game
     */
    public function addMove(Move $move): self
    {
        $this->moves[] = $move;

        $this->getChessGame()->moveSquare(
            $move->getFrom(),
            $move->getTo(),
            $move->getPromotion()
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getMoves(): array
    {
        return $this->moves;
    }
}