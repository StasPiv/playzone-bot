<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 14:08
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData;

class WSIntroduction implements WSRequestDataInterface
{
    use WSRequestDataTrait;

    protected $dataArray = null;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $token;

    public function getScope(): string
    {
        return 'introduction';
    }

    public function getMethod(): string
    {
        return 'introduction';
    }

    /**
     * Introduction constructor.
     * @param string $login
     * @param string $token
     */
    public function __construct($login, $token)
    {
        $this->login = $login;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return WSIntroduction
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
     * @return WSIntroduction
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}