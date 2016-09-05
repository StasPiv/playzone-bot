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

$serverConfigFileName = __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'server'.
                  DIRECTORY_SEPARATOR.$argv[2].'.json';

if (!file_exists($botConfigFileName)) {
    throw new \RuntimeException('No config file for bot found');
}

if (!file_exists($serverConfigFileName)) {
    throw new \RuntimeException('No config file for server found');
}

$bot = new Bot(
    SerializerBuilder::create()->build()->deserialize(
        file_get_contents($botConfigFileName),
        BotConfiguration::class,
        'json'
    ),
    SerializerBuilder::create()->build()->deserialize(
        file_get_contents($serverConfigFileName),
        ServerConfiguration::class,
        'json'
    ),
    new BotLogger(__DIR__.'/../logs/bot.log')
);
$bot->run();
