<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if(!$data || !isset($data['token'],$data['chat_id'],$data['text'])){
    echo json_encode(['ok'=>false,'description'=>'Missing parameters']); exit;
}

$token = $data['token'];
$chat  = $data['chat_id'];
$text  = $data['text'];

$url = "https://api.telegram.org/bot$token/sendMessage";
$payload = json_encode(['chat_id'=>$chat,'text'=>$text]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
