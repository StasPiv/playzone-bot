<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 28.08.16
 * Time: 12:11
 */

use StasPiv\ChessBestMove\Model\EngineConfiguration;
use StasPiv\PlayzoneBot\Model\BotConfiguration;
use StasPiv\PlayzoneBot\Model\BotConfiguration\ChallengeConfiguration;
use StasPiv\PlayzoneBot\Model\ServerConfiguration\TestServerConfiguration;
use StasPiv\PlayzoneBot\Service\Bot;
use StasPiv\PlayzoneBot\Service\EchoLogger;

require_once '../vendor/autoload.php';

$botConfiguration = new BotConfiguration();
$botConfiguration->setLogin('Glaurung')
                 ->setToken('994b884e706a9bb26a19906364a3b2b3')
                  ;

$engineConfiguration = new EngineConfiguration('glaurung');

$engineConfiguration->addOption('Skill Level', 20)
                    ->addOption('Hash', 1024)
                    ->addOption('Threads', 4)
                    ->setPathToPolyglotRunDir('/home/stas/work/playzone/ctg-reader/ctgexporter/examples');

$botConfiguration->setEngineConfiguration($engineConfiguration);

$challengeConfiguration = new ChallengeConfiguration();
$challengeConfiguration->setChallengeParamsIfUserIn([
    'base'      => 300000,
    'increment' => 3000
]);

$botConfiguration->setChallengeConfiguration($challengeConfiguration);

$bot = new Bot($botConfiguration, new TestServerConfiguration(), new EchoLogger());
$bot->run();
