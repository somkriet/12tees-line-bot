<?php
$access_token = 'jGjAb80VRPpw58kz0jgROQ6nztR9AkrE8FDuaMV0a29h6JeGYO2VDtzozI0r1zEg+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX34nzlozPVSB2iwuQTTqM+unUb3vrwdgJouL22bblcViAdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;