<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 19.06.16
 * Time: 17:18
 */

namespace StasPiv\PlayzoneBot\Service;

use Psr\Log\LoggerInterface;
use StasPiv\PlayzoneBot\Exception\BotDontSendAnyDataException;
use StasPiv\PlayzoneBot\Exception\CanNotResolveServerMessageException;
use StasPiv\PlayzoneBot\Exception\NoUserReplierForThisServerMessageException;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSIntroduction;
use StasPiv\PlayzoneBot\Model\RequestData\WebsocketRequestData\WSRequestDataInterface;
use StasPiv\PlayzoneBot\Model\ServerConfiguration;

/**
 * Class Bot
 * @package StasPiv\PlayzoneBot
 */
class Bot
{
    /**
     * @var BotConfiguration
     */
    private $botConfiguration;

    /**
     * @var ServerConfiguration
     */
    private $serverConfiguration;

    /**
     * @var WSRequestHandler
     */
    private $wsRequestHandler;

    /**
     * @var ServerMessageResolver
     */
    private $serverMessageResolver;

    /**
     * @var HttpRequestHandler
     */
    private $httpRequestHandler;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Bot constructor.
     * @param BotConfiguration $botConfiguration
     * @param ServerConfiguration $serverConfiguration
     * @param LoggerInterface $logger
     */
    public function __construct(
        BotConfiguration $botConfiguration,
        ServerConfiguration $serverConfiguration,
        LoggerInterface $logger
    )
    {
        $this->botConfiguration = $botConfiguration;
        $this->serverConfiguration = $serverConfiguration;
        $this->logger = $logger;
        $this->initClientAndRequestHandler();
        $this->httpRequestHandler = new HttpRequestHandler($this->serverConfiguration->getApiUrl());

        $this->serverMessageResolver = new ServerMessageResolver(
            $this->serverConfiguration,
            $this->botConfiguration,
            $this->logger,
            $this->wsRequestHandler,
            $this->httpRequestHandler
        );
    }

    /**
     * @return void
     */
    private function initClientAndRequestHandler()
    {
        $client = new Client($this->serverConfiguration->getWsServerUrl(),[
            'timeout' => -1
        ]);

        $this->wsRequestHandler = new WSRequestHandler($client, $this->logger);
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->wsRequestHandler->sendRequestData(
            new WSIntroduction($this->botConfiguration->getLogin(), $this->botConfiguration->getToken())
        );

        while (true) {
            try {
                $serverMessage = $this->wsRequestHandler->getLastMessageAsArray();
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
                continue;
            }

            if (!isset($serverMessage['method'])) {
                continue;
            }

            try {
                $this->serverMessageResolver->resolve($serverMessage);
            } catch (NoUserReplierForThisServerMessageException $e) {
                continue;
            } catch (BotDontSendAnyDataException $e) {
                continue;
            } catch (CanNotResolveServerMessageException $e) {
                continue;
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}