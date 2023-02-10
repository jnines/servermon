<?php
header("Content-Type: application/json");
/* Configure Start */
$server_name = "https://ash.lan";
/*
$servers[] = array(
    "name" => "NAME to give server",
    "address" => "IP/ADDRESS if different from $server_name",
    "port" => "PORT"
    );
*/
/* Icons from fontawesome.com */
$servers[] = array(
    "name" => "jellyFin",
    "address" => "",
    "port" => "",
    "url" => "/jellyfin/web/index.html",
    "fa_icon" => "fas fa-circle-play"
);
$servers[] = array(
    "name" => "plex",
    "address" => "",
    "port" => "",
    "url" => "/web",
    "fa_icon" => "fas fa-circle-play"
);
$servers[] = array(
    "name" => "sonarr",
    "address" => "",
    "port" => "",
    "url" => "/sonarr/calendar",
    "fa_icon" => "fas fa-tv"
);
$servers[] = array(
    "name" => "radarr",
    "address" => "",
    "port" => "",
    "url" => "/radarr",
    "fa_icon" => "fas fa-film"
);
$servers[] = array(
    "name" => "lidarr",
    "address" => "",
    "port" => "",
    "url" => "/lidarr",
    "fa_icon" => "fas fa-music"
);
$servers[] = array(
    "name" => "prowlarr",
    "address" => "",
    "port" => "",
    "url" => "/prowlarr",
    "fa_icon" => "fas fa-list-ul"
);
$servers[] = array(
    "name" => "ombi",
    "address" => "",
    "port" => "",
    "url" => "/ombi/requests-list",
    "fa_icon" => "fas fa-magnifying-glass"
);
$servers[] = array(
    "name" => "transmission",
    "address" => "",
    "port" => "",
    "url" => "/transmission/web/",
    "fa_icon" => "fas fa-cloud-arrow-down"
);

/* Config End */
$server_up = "";
foreach ($servers as $server) {
    if ($server['address'] == "") {
        $server['address'] = $server_name;
    }
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

    if (!in_array($http_code, ['200', '301', '302', '401', '405'], false)) {
        $server_up = 'offline';
    } else {
        $server_up = 'online';
    }
    $set_json[] = ["name" => "$server[name]", "address" => "$server[address]", "port" => "$server[port]", "fa_icon" => "$server[fa_icon]", "url" => "$server[url]", "status" => "$server_up"];
    curl_close($curl);
}
$json = json_encode($set_json);
echo $json;
