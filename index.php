<?php
/*

**Notlar**
Test olarak mevcut apikey kullanabilirsiniz, limit olduğu için hata verebilir

--> https://api.collectapi.com/
adresinden ücretsiz bir şekidle apikey oluşturabilirsiniz

*/


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.collectapi.com/health/dutyPharmacy?il=Diyarbakir",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: apikey 0iT8yXDbBKwVsmd2XGWzd6:7qCyU81GDUwdKMQ2A9iedp",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}

$pharmacy = json_decode($response, true);


$harmacy_all = $pharmacy['result'];

foreach ($harmacy_all as $pharmacys) {
  echo $pharmacys['name'] . " - " . $pharmacys['dist'] . " - " .  $pharmacys['address'] . " - " .  $pharmacys['phone'] . " - " .  $pharmacys['loc'] . "<hr>";
}
