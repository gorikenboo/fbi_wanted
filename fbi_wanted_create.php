<?php
// どこの情報か？

$field_offices =  $_GET["field"];
var_dump($field_offices);

// リクエストするURLとパラメータ
$url = "https://api.fbi.gov/wanted/v1/list?field_offices=" . $field_offices;
// $url = 'https://api.fbi.gov/wanted/v1/list?page=2';

// curlの処理を始める合図
$curl = curl_init($url);

// リクエストのオプションをセットしていく
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); // メソッド指定
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

// レスポンスを変数に入れる
$response = curl_exec($curl);

// curlの処理を終了
curl_close($curl);

// 取ってきたデータをいい感じに
$response_decode = json_decode($response);
$response_reencode = json_encode($response_decode);
$php_result = json_decode($response_reencode, true);
$html_result = json_encode($php_result);

//csvに書き込み 
$fp = fopen('data/file.csv', 'a');

for ($i = 0; $i < 20; $i++) {
    fputcsv($fp, array(
        "title", $php_result["items"][$i]["title"],
        "subject", $php_result["items"][$i]["subjects"][0],
        // "details", $json2["items"][$i]["details"],
        "reward_text", $php_result["items"][$i]["reward_text"],
        "img_url", $php_result["items"][$i]["images"][0]["original"]
    ));
}
fclose($fp);

// 20件以上だった場合
if (20 <= $php_result["total"]) {
    $url2 = "https://api.fbi.gov/wanted/v1/list?field_offices=" . $field_offices . "&page=2";

    // curlの処理を始める合図
    $curl2 = curl_init($url2);

    // リクエストのオプションをセットしていく
    curl_setopt($curl2, CURLOPT_CUSTOMREQUEST, 'GET'); // メソッド指定
    curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

    // レスポンスを変数に入れる
    $response2 = curl_exec($curl2);

    // curlの処理を終了
    curl_close($curl2);

    // 取ってきたデータをいい感じに
    $response_decode2 = json_decode($response2);
    $response_reencode2 = json_encode($response_decode2);
    $php_result2 = json_decode($response_reencode2, true);
    $html_result2 = json_encode($php_result2);

    //csvに書き込み 
    $fp = fopen('data/file.csv', 'a');

    for ($i = 0; $i < $php_result2["total"] - 20; $i++) {
        fputcsv($fp, array(
            "title", $php_result2["items"][$i]["title"],
            "subject", $php_result2["items"][$i]["subjects"][0],
            // "details", $json2["items"][$i]["details"],
            "reward_text", $php_result2["items"][$i]["reward_text"],
            "img_url", $php_result2["items"][$i]["images"][0]["original"]
        ));
    }
    fclose($fp);
}
header("Location:fbi_wanted_read.php");
