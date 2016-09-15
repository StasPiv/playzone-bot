<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 12:11
 */

use JMS\Serializer\SerializerBuilder;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\ServerConfiguration;
use StasPiv\PlayzoneBot\Service\Bot;
use StasPiv\PlayzoneBot\Logger\BotLogger;

require_once '../vendor/autoload.php';

$botConfigFileName = __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'bot'.
                  DIRECTORY_SEPARATOR.$argv[1].'.json';

$server = isset($argv[2]) ? $argv[2] : 'prod';

$serverConfigFileName = __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'server'.
                  DIRECTORY_SEPARATOR.$server.'.json';

if (!file_exists($botConfigFileName)) {
    throw new \RuntimeException('No config file for bot found');
}

if (!file_exists($serverConfigFileName)) {
    throw new \RuntimeException('No config file for server found');
}

/** @var BotConfiguration $botConfiguration */
$botConfiguration = SerializerBuilder::create()->build()->deserialize(
    file_get_contents($botConfigFileName),
    BotConfiguration::class,
    'json'
);
/** @var ServerConfiguration $serverConfiguration */
$serverConfiguration = SerializerBuilder::create()->build()->deserialize(
    file_get_contents($serverConfigFileName),
    ServerConfiguration::class,
    'json'
);

$botLogger = new BotLogger(__DIR__.'/../logs/bot.log', $botConfiguration->getLogin());

$bot = new Bot($botConfiguration, $serverConfiguration, $botLogger);
$bot->run();
