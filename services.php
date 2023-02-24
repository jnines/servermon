<?php
header("Content-Type: application/json");
/* Configure Start */
/*
$servers[] = array(
    "name" => "NAME to give server",
    "url" => "endpoint URL",
    "fa_icon" => "FontAwesome Icon"
    );
*/
/* Icons from fontawesome.com */
$servers[] = array(
    "name" => "jellyFin",
    "url" => "https://ash.lan/jellyfin/web/index.html",
    "fa_icon" => "fas fa-circle-play"
);
$servers[] = array(
    "name" => "plex",
    "url" => "https://ash.lan/web",
    "fa_icon" => "fas fa-circle-play"
);
$servers[] = array(
    "name" => "sonarr",
    "url" => "https://ash.lan/sonarr/calendar",
    "fa_icon" => "fas fa-tv"
);
$servers[] = array(
    "name" => "radarr",
    "url" => "https://ash.lan/radarr",
    "fa_icon" => "fas fa-film"
);
$servers[] = array(
    "name" => "lidarr",
    "url" => "https://ash.lan/lidarr",
    "fa_icon" => "fas fa-music"
);
$servers[] = array(
    "name" => "prowlarr",
    "url" => "https://ash.lan/prowlarr",
    "fa_icon" => "fas fa-list-ul"
);
$servers[] = array(
    "name" => "bazarr",
    "url" => "https://ash.lan/bazarr/series",
    "fa_icon" => "fas fa-closed-captioning"
);
$servers[] = array(
    "name" => "ombi",
    "url" => "https://ash.lan/ombi/requests-list",
    "fa_icon" => "fas fa-magnifying-glass"
);
$servers[] = array(
    "name" => "transmission",
    "url" => "https://ash.lan/transmission/web/",
    "fa_icon" => "fas fa-cloud-arrow-down"
);

/* Config End */
$server_up = "";
foreach ($servers as $server) {
    $curl = curl_init($server['address'] . $server['url']);
    @curl_setopt($curl, CURLOPT_PORT, $server['port']);
    @curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    @curl_setopt($curl, CURLOPT_NOBODY, true);
    @curl_setopt($curl, CURLOPT_FAILONERROR, true);
    @curl_setopt($curl, CURLOPT_HEADER, false);
    @curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    @curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    $service_name = $server['name'];
    $response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

    if (!in_array($http_code, ['200', '301', '302'], false)) {
        $server_up = 'offline';
    } else {
        $server_up = 'online';
    }
    $set_json[] = ["name" => "$server[name]", "fa_icon" => "$server[fa_icon]", "url" => "$server[url]", "status" => "$server_up"];
    curl_close($curl);
}
$json = json_encode($set_json);
echo $json;
