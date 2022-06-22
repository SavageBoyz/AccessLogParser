<?php

require_once 'src/Services/AccessLogParser.php';
require_once 'src/Services/FileServiceWrapper.php';
require_once 'src/Services/PregServiceWrapper.php';
require_once 'src/Services/ArrayServiceWrapper.php';
require_once 'src/Services/StrServiceWrapper.php';
require_once 'src/Services/JsonServiceWrapper.php';
require_once 'src/Entity/AccessLogOutput.php';

use App\Services;
use App\Entity;

const FILE_NAME = './access_log.txt';

$pregServiceWrapper = new Services\PregServiceWrapper();
$arrayServiceWrapper = new Services\ArrayServiceWrapper();
$strServiceWrapper = new Services\StrServiceWrapper();
$accessLogParser = new Services\AccessLogParser($pregServiceWrapper, $arrayServiceWrapper, $strServiceWrapper);

$fileService = new Services\FileServiceWrapper();
$fileContext = $fileService->file(FILE_NAME);
$accessLogParserFullInfo = $accessLogParser->getFullInfo($fileContext);

$views = $accessLogParserFullInfo->views();
$urls = count($accessLogParserFullInfo->uniqueUrls());
$traffic = $accessLogParserFullInfo->trafficVolume();
$crawlers = $accessLogParserFullInfo->crawlers();
$statusCodes = $accessLogParserFullInfo->statusCodes();

$accessLogOutput = new Entity\AccessLogOutput($views, $urls, $traffic, $crawlers, $statusCodes);
$jsonServiceWrapper = new Services\JsonServiceWrapper();

var_dump($jsonServiceWrapper->jsonEncode($accessLogOutput, JSON_PRETTY_PRINT));
