<?php

require_once('./vendor/autoload.php');

$API_URL = 'https://api.line.me/v2/bot/message';

$channel_token = 'h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU='; 

$channelSecret = '01105a9432439cd39fe7d25592baf0e4';

// การตั้งเกี่ยวกับ bot
// require_once 'bot_setting.php';

// Database
$host = 'ec2-3-229-210-93.compute-1.amazonaws.com';
$dbname = 'dbud41ic7prd1b';
$user = 'vymkgetnrcudai';
$pass = 'ffc3459e10c05dbc1a0f7a51058eec466302af9c07a874f74944d4d4b9790902';
$connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
// Database

$db = parse_url(getenv("postgres://vymkgetnrcudai:ffc3459e10c05dbc1a0f7a51058eec466302af9c07a874f74944d4d4b9790902@ec2-3-229-210-93.compute-1.amazonaws.com:5432/dbud41ic7prd1b"));
$db["db"] = ltrim($db["db"], "/");

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $channel_token); // เชื่อมต่อกับ LINE Messaging API

$request = file_get_contents('php://input');   // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$request_array = json_decode($request, true);   // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array

// $fileType = $response->getHeader('Content-Type');  
if (sizeof($request_array['events']) > 0 ) {

        $replyToken = $request_array['events'][0]['replyToken'];
        $userID = $request_array['events'][0]['source']['userId'];  // user id ของคนที่คุยกับบอท
        $sourceType = $request_array['events'][0]['source']['type']; //ชนิดของข้อมูล 
        $userMessage = $request_array['events'][0]['message']['text']; //ข้อความของ user ที่ส่งเข้ามา


        foreach ($request_array['events'] as $event) {
     
            if ($event['type'] == 'message') {//ตรวจสอบว่า event ที่userส่งมาเป็น type อะไร

                        switch($event['message']['type']) {//ตรวจสอบ ข้อความที่ส่งมา

                            case 'text':
                                $messageID = $event['message']['id'];
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

                                  $params = array(
                                      'log' => $event['message']['text'],
                                  );
                                  $statement = $connection->prepare("INSERT INTO logs (log) VALUES (:log)");
                                  $result = $statement->execute($params);

                               
                                $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                                $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
                                echo "Result: ".$send_result."\r\n";

                            break;
                            case 'image':
                                $messageID = $event['message']['id'];
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

                                // list($typeFile,$ext) = explode("/",'image');
                                // $ext = ($ext=='jpeg' || $ext=='jpg')?"jpg":$ext;
                                // $fileNameSave = time().".".$ext;


                                // $botDataFolder = 'botdata/'; // โฟลเดอร์หลักที่จะบันทึกไฟล์
                                // $botDataUserFolder = $botDataFolder.$userID; // มีโฟลเดอร์ด้านในเป็น userId อีกขั้น
                                // if(!file_exists($botDataUserFolder)) { // ตรวจสอบถ้ายังไม่มีให้สร้างโฟลเดอร์ userId
                                //     mkdir($botDataUserFolder, 0777, true);
                                // }   

                                // // กำหนด path ของไฟล์ที่จะบันทึก
                                // $fileFullSavePath = $botDataUserFolder.'/'.$fileNameSave;
                                // file_put_contents($fileFullSavePath,$dataBinary); // ทำการบันทึกไฟล์
                                // $textReplyMessage = "บันทึกไฟล์เรียบร้อยแล้ว $fileNameSave";
                                // $replyData = new TextMessageBuilder($textReplyMessage);

                               
                                $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
                                $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
                                echo "Result: ".$send_result."\r\n";

                            break;
                            case 'sticker':
                                $messageID = $event['message']['id'];
                                // Get replyToken
                                $reply_token = $event['replyToken'];

                                // Reply message
                                $respMessage = 'Hello, your message is '. 'sticker';

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
                            case 'audio':

                                $messageID = $event['message']['id'];
                                // Get replyToken
                                $reply_token = $event['replyToken'];

                                // Reply message
                                $respMessage = 'Hello, your message is '. 'audio';

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
                            case 'video':

                                $messageID = $event['message']['id'];
                                // Get replyToken
                                $reply_token = $event['replyToken'];

                                // Reply message
                                $respMessage = 'Hello, your message is '. $messageID;

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
                                $respMessage = "คุณไม่ได้พิมพ์ ค่า ตามที่กำหนด";

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


                        }
                       
                        // default:
                        //     $textReplyMessage = json_encode($events);
                        //     $replyData = new TextMessageBuilder($textReplyMessage);         
                        // break;  
                        // }
            }else{

                $respMessage = " คุณไม่ได้พิมพ์ ค่า ตามที่กำหนดAA";

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

// function send_reply_message_img($url, $post_header, $post_body,$msg_id)
// {
//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//     $result = curl_exec($ch);
//     curl_close($ch);

//     $fp = 'botdata/'.$msg_id.'.png';
//     $url_img="http://103.40.151.6/line_bot_gts_issue/".$fp;
//     file_put_contents( $fp, $data );

// //     $fp = ‘img_file/’.$msg_id.’.png’;
// // $url_img=”http://103.40.151.6/line_bot_gts_issue/”.$fp;
// // file_put_contents( $fp, $data );

//     return $result;
// } 


?>
