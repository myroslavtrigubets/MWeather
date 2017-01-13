<?php

require_once 'modules/ApiTelegram.php';
require_once 'modules/Answer.php';
require_once 'modules/Command.php';
require_once 'modules/config.php';

$go = new ApiTelegram($config['token']);
$answer = new Answer();
$command = new Command();

$go->setWebhook('URL');
$getUpdate = $go->getUpdate('php://input');
$getAnswer = $answer->getAnswer($getUpdate['message']['text'], $dictionary);
$getCommand = $command->getCommand($getUpdate['message']['text'], $commandList);
if ($getAnswer){
   $go->sendMessage($getUpdate['message']['from']['id'], $getAnswer);
}
if ($getCommand){
    $go->sendMessage($getUpdate['message']['from']['id'], $getCommand);
}
