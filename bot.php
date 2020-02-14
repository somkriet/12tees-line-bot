<?php

// เชื่อมต่อกับ LINE Messaging API
// $httpClient = new CurlHTTPClient('h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU=');
// $bot = new LINEBot($httpClient, array('channelSecret' => '01105a9432439cd39fe7d25592baf0e4'));

$API_URL = 'https://api.line.me/v2/bot/message';

$ACCESS_TOKEN = 'h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU='; 

$channelSecret = '01105a9432439cd39fe7d25592baf0e4';

// การตั้งเกี่ยวกับ bot
// require_once 'bot_setting.php';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN); // เชื่อมต่อกับ LINE Messaging API

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
//             'messages' => [['type' => 'text', 'text' => $text ]],

//             'replyToken' => $reply_token,
//             // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
//             'messages' => [['type' => 'text', 'text' => $text ]]

//         ];

//         $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

//         $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

//         echo "Result: ".$send_result."\r\n";
//     }
// }


/////////////////////////////////////////////////////////////////////////////////////////
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
    $typeMessage = $events['events'][0]['message']['type'];
    $userMessage = $events['events'][0]['message']['text'];
    switch ($typeMessage){
        case 'text':
            switch ($userMessage) {
                case "A":
                    $textReplyMessage = "คุณพิมพ์ A";
                    break;
                case "B":
                    $textReplyMessage = "คุณพิมพ์ B";
                    break;
                default:
                    $textReplyMessage = " คุณไม่ได้พิมพ์ A และ B";
                    break;                                      
            }
            break;
        default:
            $textReplyMessage = json_encode($events);
            break;  
    }
}
// ส่วนของคำสั่งจัดเตียมรูปแบบข้อความสำหรับส่ง
$textMessageBuilder = new TextMessageBuilder($textReplyMessage);
 
//l ส่วนของคำสั่งตอบกลับข้อความ
$response = $channelSecret->replyMessage($replyToken,$textMessageBuilder);

if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}
 
// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

// echo "OK";
/////////////////////////////////////////////////////////////////////////////////////////



function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
} 



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

