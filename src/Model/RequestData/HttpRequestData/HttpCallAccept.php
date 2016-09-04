<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 04.09.16
 * Time: 11:14
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData;

class HttpCallAccept implements HttpSecurityRequestDataInterface
{
    use HttpSecurityRequestDataTrait;

    /**
     * @var integer
     */
    private $callId;

    public function getUrl(): string
    {
        return 'call/'.$this->getCallId().'/accept';
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    /**
     * @return int
     */
    public function getCallId(): int
    {
        return $this->callId;
    }

    /**
     * @param int $callId
     * @return HttpCallAccept
     */
    public function setCallId(int $callId): self
    {
        $this->callId = $callId;

        return $this;
    }


}