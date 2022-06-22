<?php

require_once 'src/Services/AccessLogParser.php';
require_once 'src/Services/FileServiceWrapper.php';
require_once 'src/Services/PregServiceWrapper.php';
require_once 'src/Services/ArrayServiceWrapper.php';
require_once 'src/Services/StrServiceWrapper.php';

use App\Services;

const FILE_NAME = './access_log.txt';

$fileService = new Services\FileServiceWrapper();
$fileContext = $fileService->file(FILE_NAME);

$pregServiceWrapper = new Services\PregServiceWrapper();
$arrayServiceWrapper = new Services\ArrayServiceWrapper();
$strServiceWrapper = new Services\StrServiceWrapper();

$accessLogParser = new Services\AccessLogParser($pregServiceWrapper, $arrayServiceWrapper, $strServiceWrapper);
$accessLogParserFullInfo = $accessLogParser->getFullInfo($fileContext);
$ff;