<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 14:12
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData;

interface WSRequestDataInterface
{
    /**
     * @return string
     */
    public function getScope(): string ;

    /**
     * @return string
     */
    public function getMethod(): string ;

    /**
     * @return array
     */
    public function getDataArray(): array ;

    /**
     * @return bool
     */
    public function hasDataArray(): bool;
}