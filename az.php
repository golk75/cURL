<?php
$stream = stream_context_create(array(
    'http' => array(
        'timeout' => 20,
        'proxy' => '189.240.60.166:9090',
        'request_fulluri' => true 
    ),
    'ssl' => array(
        'SNI_enabled' => false // Disable SNI for https over http proxies
    )
));
echo file_get_contents('https://mdstrm.com/live-stream-playlist/61087e5b8e21e304a159211e.m3u8', false, $context);
?>