<?php

require_once('./vendor/autoload.php');

$API_URL = 'https://api.line.me/v2/bot/message';

$channel_token = 'h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU='; 

$channelSecret = '01105a9432439cd39fe7d25592baf0e4';

// การตั้งเกี่ยวกับ bot
// require_once 'bot_setting.php';

// Database
// $host = 'ec2-3-229-210-93.compute-1.amazonaws.com';
// $dbname = 'd97j1dos9pi7gj';
// $user = 'nusytfwxzbezmo';
// $pass = 'f5dd0b912072bed817cea74ec9288b0f34a2aabff759058f6c32acb35f45e831';
// $connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
// Database

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $channel_token); // เชื่อมต่อกับ LINE Messaging API

$request = file_get_contents('php://input');   // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$request_array = json_decode($request, true);   // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array


if (sizeof($request_array['events']) > 0 ) {

        $replyToken = $request_array['events'][0]['replyToken'];
        $userID = $request_array['events'][0]['source']['userId'];  // user id ของคนที่คุยกับบอท
        $sourceType = $request_array['events'][0]['source']['type']; //ชนิดของข้อมูล 
        $userMessage = $request_array['events'][0]['message']['text']; //ข้อความของ user ที่ส่งเข้ามา
        
        foreach ($request_array['events'] as $event) {
     
            if ($event['type'] == 'message') {//ตรวจสอบว่า event ที่userส่งมาเป็น type อะไร

                        switch($event['message']['type']) {//ตรวจสอบ ข้อความที่ส่งมา

                            case 'text':
                                // Get replyToken
                                $reply_token = $event['replyToken'];

                                // Reply message
                                $respMessage = 'Hello, your message is '. $event['message']['text'];

                                $data = [
                                     'replyToken' => $reply_token,
                                     'messages' => [
                                        // ['type' => 'text','text' => json_encode($request_array)]
                                         ['type' => 'text','text' => $respMessage]
                                     ]
                                  ];

                               
                                $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                                $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
                                echo "Result: ".$send_result."\r\n";

                            break;
                            case 'image':
                                // Get replyToken
                                $reply_token = $event['replyToken'];

                                // Reply message
                                $respMessage = 'Hello, your message is '. 'รูปภาพ';

                                $data = [
                                     'replyToken' => $reply_token,
                                     'messages' => [
                                        // ['type' => 'text','text' => json_encode($request_array)]
                                         ['type' => 'text','text' => $respMessage]
                                     ]
                                  ];

                               
                                $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                                $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
                                echo "Result: ".$send_result."\r\n";

                            break;
                        default:
                            $respMessage = " คุณไม่ได้พิมพ์ ค่า ตามที่กำหนด";

                            $data = [
                                     'replyToken' => $reply_token,
                                     'messages' => [
                                        // ['type' => 'text','text' => json_encode($request_array)]
                                         ['type' => 'text','text' => $respMessage]
                                     ]
                                  ];

                            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                                $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
                                echo "Result: ".$send_result."\r\n";         
                        break; 


                        // default:
                        //     $textReplyMessage = json_encode($events);
                        //     $replyData = new TextMessageBuilder($textReplyMessage);         
                        // break;  
                        }
            }

        }
}
echo "OK";



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
