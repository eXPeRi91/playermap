# AzerothShard Playermap

## Configure

Make a copy of config/playermap_config.php.conf and configure it.

Open pomm_conf.php and set the realmd_id

## Legion (7.3.5) notes

- This playermap now includes tabs for **Pandaria** (870), **Draenor** (1116), and **Broken Isles** (1220).
- Place map images at:
  - `img/map/pandaria.jpg`
  - `img/map/draenor.jpg`
  - `img/map/brokenisles.jpg`
- If markers are offset on your map images, tune the map parameters in `config/playermap_config.php`:
  - `$map_pandaria_scale`, `$map_pandaria_offset_x`, `$map_pandaria_offset_y`
  - `$map_draenor_scale`, `$map_draenor_offset_x`, `$map_draenor_offset_y`
  - `$map_legion_scale`, `$map_legion_offset_x`, `$map_legion_offset_y`
