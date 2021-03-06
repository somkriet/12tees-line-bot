<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = ''; 
$channelSecret = '';

// $ACCESS_TOKEN = 'h1ARwRRaXW+UeDXnvBxitQFP8KHRcMYouyCUNDrqmhUf+lLJzkXAG40V8F+Ra/nU+wFFtA64j3koPGqsQhZLBvg+KYNCrMiVOzjJlVxkzX0Nmeoj6Gr4F314Zz3pabxWIvVKuJdK+Kk6z2k3jZIfoQdB04t89/1O/w1cDnyilFU='; 
// $channelSecret = '01105a9432439cd39fe7d25592baf0e4';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN); // เชื่อมต่อกับ LINE Messaging API

$request = file_get_contents('php://input');   // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API

$request_array = json_decode($request, true);   // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array



if ( sizeof($request_array['events']) > 0 ) { // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];


        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => json_encode($request_array)]]
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

?>