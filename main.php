<?php

require_once 'src/Services/AccessLogParser.php';
require_once 'src/Services/FileServiceWrapper.php';
require_once 'src/Services/PregServiceWrapper.php';
require_once 'src/Services/ArrayServiceWrapper.php';
require_once 'src/Entity/AccessLog.php';

use App\Services;
use App\Entity;

const FILE_NAME = './access_log.txt';

$fileService = new Services\FileServiceWrapper();
$fileContext = $fileService->file(FILE_NAME);
//$accessLog = new Entity\AccessLog($fileContext); //TODO: передавать файл в сервис $accessLogParser->getFullInfo()
$pregServiceWrapper = new Services\PregServiceWrapper();
$arrayServiceWrapper = new Services\ArrayServiceWrapper();
$accessLogParser = new Services\AccessLogParser($pregServiceWrapper, $arrayServiceWrapper);
$accessLogParserFullInfo = $accessLogParser->getFullInfo($fileContext);
//$allRecords = $accessLog->allRecords();
//var_dump($allRecords);