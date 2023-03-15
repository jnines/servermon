# Servermon

A very (very) quickly written php script to return server/service status in JSON format. Used for [MyTab](https://github.com/jnines/MyTab). If for whatever reason you decide to use this, know you will likely have to play with [CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS).

## Configuration and return

Config is at the top of script.

```php
$servers[] = array(
    "name" => "jellyFin",
    "url" => "https://ash.lan/jellyfin/web/index.html",
    "fa_icon" => "fas fa-circle-play"
);
```

Returns

```json
[
  {
    "name": "jellyFin",
    "fa_icon": "fas fa-circle-play",
    "url": "https://ash.lan/jellyfin/web/index.html",
    "status": "online"
  }
]
```
