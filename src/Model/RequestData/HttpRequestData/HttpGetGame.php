<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:22
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;

class HttpGetGame implements HttpSecurityRequestDataInterface
{
    use HttpSecurityRequestDataTrait;

    /**
     * @var int
     */
    private $gameId;

    /**
     * @param int $gameId
     * @return HttpGetGame
     */
    public function setGameId(int $gameId): self
    {
        $this->gameId = $gameId;

        return $this;
    }

    public function getUrl(): string
    {
        return 'game/'.$this->gameId;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

}