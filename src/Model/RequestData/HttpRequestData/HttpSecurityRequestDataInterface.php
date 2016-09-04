<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 14:36
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;

interface HttpSecurityRequestDataInterface extends HttpRequestDataInterface
{
    /**
     * @param string $login
     * @return HttpSecurityRequestDataInterface
     */
    public function setLogin(string $login): HttpSecurityRequestDataInterface ;

    /**
     * @param string $token
     * @return HttpSecurityRequestDataInterface
     */
    public function setToken(string $token): HttpSecurityRequestDataInterface ;
}