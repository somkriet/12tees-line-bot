<?php



require "vendor/autoload.php";

// $access_token = '3ALKAbKFoGuJyJnoDdn0HeyfbxLFtEXBKiC0lFeoNl/XbL4WhoCZzefp2n7UDuXaCWfErIDro07BnZNggJmXJChXTIlMPo8LRJ+n1LEgbRUaKehDkiCr5p5CakHrPX+gauOGX/R5bB2e5yi7xjnHDAdB04t89/1O/w1cDnyilFU=';

// $channelSecret = '75c03f392f6e53d662d6f5a8db9e421f';

// $pushID = 'U7ef7a449f2a5c2057eacfc02ba2eb286';


$access_token = 'jGjAb80VRPpw58kz0jgROQ6nztR9AkrE8FDuaMV0a29h6JeGYO2VDtzozI0r1zEg+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX34nzlozPVSB2iwuQTTqM+unUb3vrwdgJouL22bblcViAdB04t89/1O/w1cDnyilFU=';

$channelSecret = '01105a9432439cd39fe7d25592baf0e4';

$pushID = 'U7ef7a449f2a5c2057eacfc02ba2eb286';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







