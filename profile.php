<?php


// $access_token = '3ALKAbKFoGuJyJnoDdn0HeyfbxLFtEXBKiC0lFeoNl/XbL4WhoCZzefp2n7UDuXaCWfErIDro07BnZNggJmXJChXTIlMPo8LRJ+n1LEgbRUaKehDkiCr5p5CakHrPX+gauOGX/R5bB2e5yi7xjnHDAdB04t89/1O/w1cDnyilFU=';
$access_token = 'jGjAb80VRPpw58kz0jgROQ6nztR9AkrE8FDuaMV0a29h6JeGYO2VDtzozI0r1zEg+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX34nzlozPVSB2iwuQTTqM+unUb3vrwdgJouL22bblcViAdB04t89/1O/w1cDnyilFU=';

// $userId = 'Uffa138efe037e6e889d0b0f4a871c005';

$userId = 'Ue27997d1463e20a2dc0928e050c337fe';




$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
