<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 23:18
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;


class HttpGetCurrentTournamentGame implements HttpSecurityRequestDataInterface
{
    use HttpSecurityRequestDataTrait;

    /**
     * @var int
     */
    private $tournamentId;

    public function getUrl(): string
    {
        return 'tournament/'.$this->getTournamentId().'/currentgame';
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * @return int
     */
    public function getTournamentId(): int
    {
        return $this->tournamentId;
    }

    /**
     * @param int $tournamentId
     * @return HttpGetCurrentTournamentGame
     */
    public function setTournamentId(int $tournamentId): self
    {
        $this->tournamentId = $tournamentId;

        return $this;
    }
}