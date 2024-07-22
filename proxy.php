<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$apiEndpoint = 'https://api.duoservers.com/?auth_username=store239582&auth_password=123&section=countries&command=get&return_type=json';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiEndpoint); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$countries = curl_exec($ch);
$data = json_decode($countries, true);
$response = $data['1']['countries'];

if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    echo json_encode($response) ;
}
curl_close($ch);

?>