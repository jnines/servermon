<!DOCTYPE html>
<html lang="en">

<head>
  <title>Server status</title>
  <meta content="text/html" charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="30">
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="stylesheet" href="servers.css" />
</head>
<html>
<body>
  <div class="container">
    <div class="row">
      <div class="iFlex">
        <?php
            $data = "";
            //configure
            $serverName = "http://ash.lan";
            $servers[] = array(
                "name" => "JellyFin",
                "ip" => "",
                "port" => "9009",
                "url" => "/web/index.html"
            );
            $servers[] = array(
                "name" => "Plex",
                "ip" => "",
                "port" => "32400",
                "url" => "/web/index.html"
            );
            $servers[] = array(
                "name" => "Sonarr",
                "ip" => "",
                "port" => "9003",
                "url" => ""
            );
            $servers[] = array(
                "name" => "Radarr",
                "ip" => "",
                "port" => "9005",
                "url" => ""
            );
            $servers[] = array(
                "name" => "Lidarr",
                "ip" => "",
                "port" => "9012",
                "url" => ""
            );
            $servers[] = array(
                "name" => "Jackett",
                "ip" => "",
                "port" => "9008",
                "url" => ""
            );
            $servers[] = array(
                "name" => "Ombi",
                "ip" => "",
                "port" => "9002",
                "url" => "/requests-list"
            );
            $servers[] = array(
                "name" => "Transmission",
                "ip" => "",
                "port" => "9006",
                "url" => "/transmission/web/"
            );

            //configure
            foreach ($servers as $server)
            {
                if ($server['ip'] == "")
                {
                    $server['ip'] = $serverName;
                }
                $curl = curl_init($server['ip']);
                @curl_setopt($curl, CURLOPT_PORT, $server['port']);
                @curl_setopt($curl, CURLOPT_NOBODY, true);
                @curl_setopt($curl, CURLOPT_FAILONERROR, true);
                @curl_setopt($curl, CURLOPT_HEADER, false);
                $serviceName = $server['name'];
                $response = curl_exec($curl);
                $http_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
                if (!in_array($http_code, ['200', '301', '302', '401'], false))
                {
                    $data .= "<div class='serverBg'><a class='serverCont' href=" . $serverName . ":" . $server['port'] . $server['url'] . " target='_blank'><div id='serverImgCont'><img src='images/" . strtolower($serviceName) . ".png' class='serverImg' alt='$serviceName image'></div><div class='serverTitle'>" . $serviceName . "</div><div class='glowOff'>Offline</div></a></div>";
                }
                else
                {
                    $data .= "<div class='serverBg'><a class='serverCont' href=" . $serverName . ":" . $server['port'] . $server['url'] . " target='_blank'><div id='serverImgCont'><img src='images/" . strtolower($serviceName) . ".png' class='serverImg' alt='$serviceName image'></div><div class='serverTitle'>" . $serviceName . "</div><div class='glowOn'>Online</div></a></div>";
                }

                curl_close($curl);
            }

            echo $data;

            ?>

      </div>
    </div>
  </div>
</body>
</html>
