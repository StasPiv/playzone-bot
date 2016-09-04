<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 13:22
 */

namespace StasPiv\PlayzoneBot\Model;

use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSRequestDataInterface;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSRequestDataTrait;

class Request implements WSRequestDataInterface
{
    use WSRequestDataTrait;

    /**
     * @var string
     */
    protected $scope;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var WSRequestDataInterface
     */
    protected $data;

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return Request
     */
    public function setScope(string $scope): self
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Request
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param WSRequestDataInterface|array $data
     * @return Request
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}