<?php

function video_downloader_soundslice($file_url) {
    $headers[] = 'Origin: https://www.soundslice.com';
    $headers[] = 'Referer: https://www.soundslice.com';

    $file_url = $file_url."/scoredata";
    $res = query_opts($file_url, $headers);
    $res_json = json_decode($res, true);

    foreach($res_json["r"] as $item) {
        if(isset($item["hls"])) {
            fdownload($item["mediaUrl"], filter_filename($item["name"].".mp4"));
        } else {
            $res = query_opts($item["mediaUrl"], $headers);
            $res_json = json_decode($res, true);
            fdownload($res_json["url"], filter_filename($item["name"].".mp4"));
        }
    }
}