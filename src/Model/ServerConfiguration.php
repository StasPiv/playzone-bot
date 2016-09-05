<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 12:36
 */

namespace StasPiv\PlayzoneBot\Model;

use JMS\Serializer\Annotation as JMS;

class ServerConfiguration
{
    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $wsServerUrl = 'ws://ws.playzone.immortalchess.net:8081/';

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $apiUrl = 'http://api.playzone.immortalchess.net/';

    /**
     * @return string
     */
    public function getWsServerUrl(): string
    {
        return $this->wsServerUrl;
    }

    /**
     * @param string $wsServerUrl
     * @return ServerConfiguration
     */
    public function setWsServerUrl(string $wsServerUrl): self
    {
        $this->wsServerUrl = $wsServerUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return ServerConfiguration
     */
    public function setApiUrl(string $apiUrl): self
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }
}