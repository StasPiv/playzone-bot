<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 1:34
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;

interface HttpRequestDataInterface
{
    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getMethod(): string;
}