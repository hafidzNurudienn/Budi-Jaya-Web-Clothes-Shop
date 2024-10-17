<?php
include 'database.php';
$province_id = $_POST['province_id'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$province_id",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key:81d4424e2b099f8b8ea33708087f4b8c"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

$data = json_decode($response, true);
echo json_encode($data['rajaongkir']['results']);
?>
