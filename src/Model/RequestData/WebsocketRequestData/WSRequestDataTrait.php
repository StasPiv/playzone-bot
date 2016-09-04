<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 13:31
 */

namespace StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData;

trait WSRequestDataTrait
{
    /**
     * @var array
     */
    protected $dataArray = [];

    /**
     * @return array
     */
    public function getDataArray(): array
    {
        return $this->dataArray;
    }

    /**
     * @param array $dataArray
     * @return self
     */
    public function setDataArray(array $dataArray): self
    {
        $this->dataArray = $dataArray;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDataArray(): bool
    {
        return !is_null($this->dataArray);
    }
}