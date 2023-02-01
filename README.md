# Servermon

A very (very) quickly written php script to return server/service status in JSON format. Used for [MyTab](https://github.com/jnines/MyTab). If for whatever reason you decide to use this, know you will likely have to play with [CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS).

## Configuration and return

Config is at the top of script.

```php
$server_name = "https://ash.lan"; # Address to use if not specified below;  Only one instance.

$servers[] = array(
    "name" => "jellyFin", # The name you'd like to use
    "address" => "", # URL or IP address
    "port" => "", # Port if needed
    "url" => "/jellyfin/web/index.html", # Path after base address above
    "fa_icon" => "fas fa-circle-play" # FontAwesome Icon code to use
);
```

Returns

```json
[
  {
    "name": "jellyFin",
    "address": "https://ash.lan",
    "port": "",
    "fa_icon": "fas fa-circle-play",
    "url": "/jellyfin/web/index.html",
    "status": "online"
  }
]
```
