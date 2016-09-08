<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 08.09.16
 * Time: 20:43
 */

namespace StasPiv\PlayzoneBot\Service;


use Symfony\Component\Process\Process;

class RunService
{
    public static function run(string $botName, string $serverName = 'prod')
    {
        $process = new Process('php run_bot.php '.$botName.' '.$serverName);
        $process->start();
    }
}