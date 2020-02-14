<?php
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// include composer autoload
// require_once '/vendor/autoload.php';
 
// การตั้งเกี่ยวกับ bot
require_once 'bot_setting.php';
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");
 
///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
 
// เชื่อมต่อกับ LINE Messaging API
$httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
$bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));
 
// คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$content = file_get_contents('php://input');
 
// แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
$events = json_decode($content, true);
if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
}
// ส่วนของคำสั่งจัดเตียมรูปแบบข้อความสำหรับส่ง
$textMessageBuilder = new TextMessageBuilder(json_encode($events));
 
//l ส่วนของคำสั่งตอบกลับข้อความ
$response = $bot->replyMessage($replyToken,$textMessageBuilder);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}
 
// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>


<!-- // // $API_URL = 'https://api.line.me/v2/bot/message';
// // $ACCESS_TOKEN = 'h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU='; 
// // $channelSecret = '01105a9432439cd39fe7d25592baf0e4';

// // การตั้งเกี่ยวกับ bot
// require_once 'bot_setting.php';

// $POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN); // เชื่อมต่อกับ LINE Messaging API

// $request = file_get_contents('php://input');   // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
// $request_array = json_decode($request, true);   // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array



// if ( sizeof($request_array['events']) > 0 ) {

//     foreach ($request_array['events'] as $event) {

//         $reply_message = '';
//         $reply_token = $event['replyToken'];

//         $text = $event['message']['text'];

//         $data = [
//             'replyToken' => $reply_token,
//             // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
//             'messages' => [['type' => 'text', 'text' => $text ]]
//         ];

//         $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

//         $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

//         echo "Result: ".$send_result."\r\n";
//     }
// }

// echo "OK";




// function send_reply_message($url, $post_header, $post_body)
// {
//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//     $result = curl_exec($ch);
//     curl_close($ch);

//     return $result;
// } -->

