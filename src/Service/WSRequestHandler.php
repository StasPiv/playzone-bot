<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 13:24
 */

namespace StasPiv\PlayzoneBot\Service;

use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Model\Request;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSRequestDataInterface;

class WSRequestHandler
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * RequestSender constructor.
     * @param Client $client
     * @param LoggerInterface $logger
     */
    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    private function receive()
    {
        return $this->client->receive();
    }

    /**
     * @return array
     */
    public function getLastMessageAsArray(): array
    {
        $lastMessage = json_decode($this->receive(), true);

        if (!is_array($lastMessage)) {
            return [];
        }

        return $lastMessage;
    }

    /**
     * @param WSRequestDataInterface $data
     */
    public function sendRequestData(WSRequestDataInterface $data)
    {
        $dataForSend = $data->hasDataArray() ? $data->getDataArray() : $data;

        $this->send(
            (new Request())->setScope($data->getScope())->setMethod($data->getMethod())->setData($dataForSend)
        );
    }

    /**
     * @param WSRequestDataInterface $request
     * @return void
     */
    private function send(WSRequestDataInterface $request)
    {
        $data = SerializerBuilder::create()->build()->serialize($request, 'json');

        $this->logger->debug('SEND: '.$data);

        $this->client->send($data);
    }
}