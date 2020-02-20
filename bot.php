<?php

$API_URL = 'https://api.line.me/v2/bot/message';

$ACCESS_TOKEN = 'h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU='; 

$channelSecret = '01105a9432439cd39fe7d25592baf0e4';

// การตั้งเกี่ยวกับ bot
// require_once 'bot_setting.php';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN); // เชื่อมต่อกับ LINE Messaging API

$request = file_get_contents('php://input');   // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$request_array = json_decode($request, true);   // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array


// {"userId":"Ue27997d1463e20a2dc0928e050c337fe","type":"user"

if ( sizeof($request_array['events']) > 0 ) {

        $replyToken = $request_array['events'][0]['replyToken'];
        $userID = $request_array['events'][0]['source']['userId'];
        $sourceType = $request_array['events'][0]['source']['type'];

        


        foreach ($request_array['events'] as $event) {


            if ($event = 'test' ) {
                # code...
                $test = 'ทดสอบระบบline001';
            }else{
                $test = 'ทดสอบระบบline002';
            }
      
          $reply_message = '';
          $reply_token = $event['replyToken'];
          $data = [
             'replyToken' => $reply_token,
             'messages' => [
                // ['type' => 'text','text' => json_encode($request_array)]
                 ['type' => 'text','text' => $test]
             ]
          ];

          $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
          $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
          echo "Result: ".$send_result."\r\n";
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


//  $accessToken = "h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
// $content = file_get_contents('php://input');
//    $arrayJson = json_decode($content, true);
// $arrayHeader = array();
//    $arrayHeader[] = "Content-Type: application/json";
//    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
// //รับข้อความจากผู้ใช้
//    $message = $arrayJson['events'][0]['message']['text'];
// //รับ id ว่ามาจากไหน
//    if(isset($arrayJson['events'][0]['source']['userId']){
//       $id = $arrayJson['events'][0]['source']['userId'];
//    }
//    else if(isset($arrayJson['events'][0]['source']['groupId'])){
//       $id = $arrayJson['events'][0]['source']['groupId'];
//    }
//    else if(isset($arrayJson['events'][0]['source']['room'])){
//       $id = $arrayJson['events'][0]['source']['room'];
//    }
// #ตัวอย่าง Message Type "Text + Sticker"
//    if($message == "สวัสดี"){
//       $arrayPostData['to'] = $id;
//       $arrayPostData['messages'][0]['type'] = "text";
//       $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
//       $arrayPostData['messages'][1]['type'] = "sticker";
//       $arrayPostData['messages'][1]['packageId'] = "2";
//       $arrayPostData['messages'][1]['stickerId'] = "34";
//       pushMsg($arrayHeader,$arrayPostData);
//    }
// function pushMsg($arrayHeader,$arrayPostData){
//       $strUrl = "https://api.line.me/v2/bot/message/push";
// $ch = curl_init();
//       curl_setopt($ch, CURLOPT_URL,$strUrl);
//       curl_setopt($ch, CURLOPT_HEADER, false);
//       curl_setopt($ch, CURLOPT_POST, true);
//       curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
//       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       $result = curl_exec($ch);
//       curl_close ($ch);
//    }


// exit;
?>
