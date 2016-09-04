<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 13:42
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData;

class WSSubscribeToGame implements WSRequestDataInterface
{
    use WSRequestDataTrait;

    protected $dataArray = null;

    /**
     * @var int
     */
    private $gameId;

    /**
     * WSSubscribeToGame constructor.
     * @param int $gameId
     */
    public function __construct($gameId)
    {
        $this->gameId = $gameId;
    }

    public function getScope(): string
    {
        return 'subscribe_to_game';
    }

    public function getMethod(): string
    {
        return 'subscribe_to_game';
    }
}