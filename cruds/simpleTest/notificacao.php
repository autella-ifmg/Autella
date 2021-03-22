// Enviar notificação no aplicativo
<?php
$url = "https://fcm.googleapis.com/fcm/send";
$token = "/topics/all";
$serverKey = 'AAAAZ5Vo2h0:APA91bFJ1gJSfJ9SpvG4kCey--oN4l80C2jLmKaNm5oGH__kXNN11hmwBFkARRSRdJaSYYj1iDaRdVpiAtT9WI-7E_0Zl74Nr_EZUm_nrXPGAf3KBIu-Jpl1B5oSLjrKnwoaaSrOTmek';
$title = "Gabarito liberado";
$body = $_GET['nomeDaProva'] . ": gabarito liberado!";
$notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1');
$arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
$json = json_encode($arrayToSend);
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: key=' . $serverKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//Send the request
$response = curl_exec($ch);
//Close request
if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
header('Location: ' . $_SERVER['HTTP_REFERER']);
