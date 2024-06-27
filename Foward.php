<?php
public function callback($curl, $data)

{
    ob_get_clean();
    if (($data === false) || ($data == null))
    {
        throw new Exception (curl_error($curl) . " " . curl_errno($curl));
    }
    $length = strlen($data);
    header("Content-type: video/mp4");
    header("Transfer-encoding: chunked");
    header("Connection: keep-alive");
    header("Cache-Control: max-age=2592000, public");
    header("Expires: ".gmdate('D, d M Y H:i:s', time()+2592000) . ' GMT');
    header("Last-Modified: ".gmdate('D, d M Y H:i:s', @filemtime($this->path)) . ' GMT' );
    echo $data;
    ob_flush();
    flush();
    return $length;
}

public function getStreamChunk($camera_id)
{
    $url = "https://linear-360.frequency.stream/mt/studio/360/hls/master/playlist.m3u8"; //url of noted video server
    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_USERPWD => "$this->login:$this->pass",
            CURLOPT_BUFFERSIZE => (1024*1024),
            CURLOPT_WRITEFUNCTION => array($this, "callback")
        )
    );
    curl_exec($curl);
    curl_close($curl);
}
?>