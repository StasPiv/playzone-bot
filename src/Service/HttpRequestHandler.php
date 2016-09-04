<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 30.08.16
 * Time: 0:27
 */

namespace StasPiv\PlayzoneBot\Service;

use GuzzleHttp\Client as GuzzleClient;
use JMS\Serializer\SerializerBuilder;
use StasPiv\PlayzoneBot\Model\RequestData\HttpRequestData\HttpRequestDataInterface;

class HttpRequestHandler
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var Client
     */
    private $client;

    /**
     * HttpRequestHandler constructor.
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->client = new GuzzleClient();
    }

    /**
     * @param HttpRequestDataInterface $request
     * @return array
     */
    public function send(HttpRequestDataInterface $request): array
    {
        $requestArray = json_decode(
            SerializerBuilder::create()->build()->serialize($request, 'json'),
            true
        );

        switch ($request->getMethod()) {
            case 'GET':
                $response = $this->client->request(
                    $request->getMethod(),
                    $this->baseUrl . $request->getUrl().'?'.http_build_query($requestArray)
                );
                break;
            default:
                $response = $this->client->request(
                    $request->getMethod(),
                    $this->baseUrl . $request->getUrl(),
                    [
                        'form_params' => $requestArray
                    ]
                );
        }

        return json_decode($response->getBody(), true);
    }
}