<?php
require_once 'src/Controller/AccessLogController.php';
require_once 'src/Services/AccessLogParser.php';
require_once 'src/Services/FileServiceWrapper.php';
require_once 'src/Services/PregServiceWrapper.php';
require_once 'src/Services/ArrayServiceWrapper.php';
require_once 'src/Models/AccessLog.php';

use App\Controller\AccessLogController;
use App\Services;
use App\Models\AccessLog;

const PARSE_PATTERN = '/(.+)\s-\s-\s\[(.+)\]\s"([a-zA-Z]+)\s(\S+)\s([^"]+)"\s(\d+)\s(\d+)\s"([^"]+)"\s"([^"]+)"/';
const FILE_NAME = './access_log.txt';

$fileService = new Services\FileServiceWrapper();
$fileContext = $fileService->file(FILE_NAME);

$accessLog = new AccessLog($fileContext, PARSE_PATTERN);
$pregServiceWrapper = new Services\PregServiceWrapper();
$arrayServiceWrapper = new Services\ArrayServiceWrapper();
$accessLogParser = new Services\AccessLogParser($accessLog, $pregServiceWrapper, $arrayServiceWrapper);

$accessLogController = new AccessLogController($accessLogParser);
$accessLogController->getFullInfo();
//$allRecords = $accessLog->allRecords();
//var_dump($allRecords);