<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:39
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;


trait HttpSecurityRequestDataTrait
{
    /**
     * @var string
     */
    protected $login;
    /**
     * @var string
     */
    protected $token;

    /**
     * HttpSendChallenge constructor.
     * @param string $login
     * @param string $token
     */
    public function __construct(string $login, string $token)
    {
        $this->login = $login;
        $this->token = $token;
    }

    /**
     * @param string $login
     * @return HttpSecurityRequestDataInterface
     */
    public function setLogin(string $login): HttpSecurityRequestDataInterface
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @param string $token
     * @return HttpSecurityRequestDataInterface
     */
    public function setToken(string $token): HttpSecurityRequestDataInterface
    {
        $this->token = $token;

        return $this;
    }
}