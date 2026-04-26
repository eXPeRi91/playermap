# AzerothShard Playermap Installation Guide

Version: **1.0.0.A (Alpha)**

## 1) Requirements

- PHP 7.x+ with MySQL extension enabled (this project currently uses `mysql_*` APIs).
- MySQL/MariaDB access to:
  - `auth` (realm)
  - `characters`
  - `world`
- A web server (Apache/Nginx) serving this repository.

## 2) Copy and configure runtime config

1. Copy:
   - `config/playermap_config.php.conf` → `config/playermap_config.php`
2. Edit credentials and realm settings in `config/playermap_config.php`:
   - `$realm_db[...]`
   - `$characters_db[...]`
   - `$world_db[...]`
   - `$server[...]`

## 3) Verify realm and language setup

- `pomm_conf.php` reads the selected realm from `cur_selected_realmd` cookie, with safe fallback to realm `1`.
- Ensure `map_english.php` and `zone_names_english.php` are present (default English setup).

## 4) Map images (remote + local)

### Local base maps required

Keep local files for classic layers:
- `img/map/azeroth.jpg`
- `img/map/outland.jpg`
- `img/map/northrend.jpg`

### Remote zone/expansion maps

This project uses:
- `https://wow.zamimg.com/images/wow/maps/enus/original/<zone>-<phase>.jpg`

Configured in:
- `$map_remote_image_base`
- `$map_zone_image_default_phase`
- `$map_pandaria_zone_id`, `$map_pandaria_phase`
- `$map_draenor_zone_id`, `$map_draenor_phase`
- `$map_legion_zone_id`, `$map_legion_phase`

## 5) Optional map tuning

If marker positions look off on expansion maps, tune:
- `$map_pandaria_scale`, `$map_pandaria_offset_x`, `$map_pandaria_offset_y`
- `$map_draenor_scale`, `$map_draenor_offset_x`, `$map_draenor_offset_y`
- `$map_legion_scale`, `$map_legion_offset_x`, `$map_legion_offset_y`

## 6) Quick validation

Run:

```bash
php -l config/playermap_config.php.conf
php -l pomm_conf.php
php -l pomm_play.php
php -l index.php
```

## 7) Open the application

- Navigate to `index.php` in your browser.
- You should see map tabs and online markers.
- Tooltip `Zone image` links open zone images directly from ZAM host.
