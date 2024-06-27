<?php
$filename = "https://linear-360.frequency.stream/mt/studio/360/hls/master/playlist.m3u8";
header('Content-Type: application/octet-stream');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$filename);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
$data=curl_exec($ch);
curl_close($ch);
?>