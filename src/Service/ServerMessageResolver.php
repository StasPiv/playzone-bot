<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 03.09.16
 * Time: 0:55
 */

namespace StasPiv\PlayzoneBot\Service;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Exception\CanNotResolveServerMessageException;
use StasPiv\PlayzoneBot\Exception\NoUserReplierForThisServerMessageException;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\ServerConfiguration;
use StasPiv\PlayzoneBot\Service\Replier\ReplierFactory;

class ServerMessageResolver
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * @var HttpRequestHandler
     */
    private $httpRequestHandler;

    /**
     * @var BotConfiguration
     */
    private $botConfiguration;
    /**
     * @var WSRequestHandler
     */
    private $wsRequestHandler;

    /**
     * RequestDataResolver constructor.
     * @param ServerConfiguration $serverConfiguration
     * @param BotConfiguration $botConfiguration
     * @param LoggerInterface $logger
     * @param WSRequestHandler $wsRequestHandler
     * @param HttpRequestHandler $httpRequestHandler
     */
    public function __construct(
        ServerConfiguration $serverConfiguration,
        BotConfiguration $botConfiguration,
        LoggerInterface $logger,
        WSRequestHandler $wsRequestHandler,
        HttpRequestHandler $httpRequestHandler
    )
    {
        $this->serverConfiguration = $serverConfiguration;
        $this->logger = $logger;
        $this->httpRequestHandler = new HttpRequestHandler($this->serverConfiguration->getApiUrl());
        $this->botConfiguration = $botConfiguration;
        $this->wsRequestHandler = $wsRequestHandler;
        $this->httpRequestHandler = $httpRequestHandler;
    }

    /**
     * @param array $serverMessage
     * @return void
     * @throws NoUserReplierForThisServerMessageException
     */
    public function resolve(array $serverMessage)
    {
        if (!isset($serverMessage['scope']) || !isset($serverMessage['method'])) {
            throw new CanNotResolveServerMessageException(
                'There are no method and scope in server message: '.json_encode($serverMessage)
            );
        }

        try {
            ReplierFactory::create($serverMessage)->reply(
                $serverMessage['data'],
                $this->botConfiguration,
                $this->httpRequestHandler,
                $this->wsRequestHandler,
                $this->logger
            );
        } catch (NoUserReplierForThisServerMessageException $e) {
            // do nothing :)
        }
    }
}