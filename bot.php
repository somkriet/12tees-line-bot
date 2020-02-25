<?php

$servername = "12tees-rds.cyprrbnhl6mt.ap-southeast-1.rds.amazonaws.com";
$username = "jay";
$password = "jay123$";
$databaseName = "12tees";

$connect = new mysqli($servername,$username,$password,$databaseName);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 

echo "Connected successfully";



require_once('./vendor/autoload.php');

$API_URL = 'https://api.line.me/v2/bot/message';

$channel_token = 'h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU='; 

$channelSecret = '01105a9432439cd39fe7d25592baf0e4';

// การตั้งเกี่ยวกับ bot
// require_once 'bot_setting.php';


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
                                // $respMessage = 'Hello, your message is '. $event['message']['text'];

                                // $data = [
                                //      'replyToken' => $reply_token,
                                //      'messages' => [
                                //         // ['type' => 'text','text' => json_encode($request_array)]
                                //          ['type' => 'text','text' => $respMessage]
                                //      ]
                                //   ];


                                $multi = $event['message']['text']; 
                                $i1=1;$i2=2;$i3=3;$i4=4;$i5=5;$i6=6;$i7=7;$i8=8;$i9=9;$i10=10;$i11=11;$i12=12;   
                                    $respMessage ='แม่สูตรคูณ แม่'.$multi."\n"
                                                  .$multi.'x'.$i1.'='.$i1*$multi."\n"
                                                  .$multi.'x'.$i2.'='.$i2*$multi."\n"
                                                  .$multi.'x'.$i3.'='.$i3*$multi."\n"
                                                  .$multi.'x'.$i4.'='.$i4*$multi."\n"
                                                  .$multi.'x'.$i5.'='.$i5*$multi."\n"
                                                  .$multi.'x'.$i6.'='.$i6*$multi."\n"
                                                  .$multi.'x'.$i7.'='.$i7*$multi."\n"
                                                  .$multi.'x'.$i8.'='.$i8*$multi."\n"
                                                  .$multi.'x'.$i9.'='.$i9*$multi."\n"
                                                  .$multi.'x'.$i10.'='.$i10*$multi."\n"
                                                  .$multi.'x'.$i11.'='.$i11*$multi."\n"
                                                  .$multi.'x'.$i12.'='.$i12*$multi;

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



?>
