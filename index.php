<?php
/*

**Notlar**
Test olarak mevcut apikey kullanabilirsiniz, limit olduğu için hata verebilir

--> https://api.collectapi.com/
adresinden ücretsiz bir şekidle apikey oluşturabilirsiniz

*/

date_default_timezone_set('Europe/Istanbul'); //İstanbul Türkiye

function ayyaz($ay)
{
  switch ($ay) {
    case 1:
      return "Ocak";
      break;
    case 2:
      return "Şubat";
      break;
    case 3:
      return "Mart";
      break;
    case 4:
      return "Nisan";
      break;
    case 5:
      return "Mayıs";
      break;
    case 6:
      return "Haziran";
      break;
    case 7:
      return "Temmuz";
      break;
    case 8:
      return "Ağustos";
      break;
    case 9:
      return "Eylül";
      break;
    case 10:
      return "Ekim";
      break;
    case 11:
      return "Kasım";
      break;
    case 12:
      return "Aralık";
      break;

    default:
      return "Ay Bulunamadı !";
      break;
  }
}

function GunuAdileYaz($gun)
{
  switch ($gun) {
    case "Fri":
      return "Cuma";
      break;
    case "Sat":
      return "Cumartesi";
      break;
    case "Sun":
      return "Pazar";
      break;
    case "Mon":
      return "Pazartesi";
      break;
    case "Tue":
      return "Salı";
      break;
    case "Wed":
      return "Çarşamba";
      break;
    case "Thu":
      return "Perşembe";
      break;

    default:
      return "Ay Bulunamadı !";
      break;
  }
}

// Başlık Ayarlanıyor
$baslik = "NİĞDE NÖBETÇİ ECZANELER | " . date('d') . " " . ayyaz(date("m")) . " " . date('Y') . " " . GunuAdileYaz(date('D')) . " Nöbetçi Eczane";

// Api Start
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.collectapi.com/health/dutyPharmacy?il=Nigde",
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

// Metin Döngü İle Yazdırtıyoruz
foreach ($harmacy_all as $pharmacys) {
  // $pharmacys['name'] . " - " . $pharmacys['dist'] . " - " .  $pharmacys['address'] . " - " .  $pharmacys['phone'] . " - " .  $pharmacys['loc'] . "<hr>";
  // Eczane Adı                    İlçesi                       Adresi                            Telefon                       Konum
?>
  <!-- ITEM -->
  <h2>NİĞDE <?= $pharmacys['dist'] ?> NÖBEÇTİ ECZANE</h2>
  <p><?= $pharmacys['name'] ?> ECZANESİ</p>
  <p> <?= $pharmacys['address'] ?></p>
  <p><b>TELEFON : </b> <a href="tel:<?= $pharmacys['phone'] ?>"><?= $pharmacys['phone'] ?></a></p>
  <u> <b><a href="https://www.google.com/maps/dir/My+Location/<?= $pharmacys['loc'] ?>" target="_blank"> Yol Tarifi İçin Tıklayınız</a></b></u>
  <p><br data-cke-filler="true"></p>
  <p><br data-cke-filler="true"></p>

<?php } ?>
