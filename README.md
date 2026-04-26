# AzerothShard Playermap

Current version: **1.0.0.A** (Alpha)

For setup steps, see **[INSTALLATION.md](INSTALLATION.md)**.

## Configure

Make a copy of config/playermap_config.php.conf and configure it.

Open pomm_conf.php and set the realmd_id

## Legion (7.3.5) notes

- This playermap now includes tabs for **Pandaria** (870), **Draenor** (1116), and **Broken Isles** (1220).
- Added maps now load from ZAM image host using this fixed pattern:
  - `https://wow.zamimg.com/images/wow/maps/enus/original/<zone>-<phase>.jpg`
  - Example (Broken Shore): `https://wow.zamimg.com/images/wow/maps/enus/original/7543-0.jpg`
- Important: use **Wowhead zone IDs** (not map IDs) for `<zone>`.
- Final tuning: player tooltips now expose a direct **Zone image** link generated from each character's live `zone` ID, so missing Cata → Legion zone images can be opened with the same URL pattern.
- If markers are offset on your map images, tune the map parameters in `config/playermap_config.php`:
  - `$map_pandaria_scale`, `$map_pandaria_offset_x`, `$map_pandaria_offset_y`
  - `$map_draenor_scale`, `$map_draenor_offset_x`, `$map_draenor_offset_y`
  - `$map_remote_image_base`
  - `$map_pandaria_zone_id`, `$map_pandaria_phase`
  - `$map_draenor_zone_id`, `$map_draenor_phase`
  - `$map_legion_zone_id`, `$map_legion_phase`
  - `$map_legion_scale`, `$map_legion_offset_x`, `$map_legion_offset_y`

## Security hardening notes

- Player names and zone labels are HTML-escaped before being sent to the browser in `pomm_play.php`.
- Map URLs are generated from sanitized integer zone/phase values and a fixed allowed base prefix.
- Realm selection cookie (`cur_selected_realmd`) is validated and falls back safely to realm `1`.
- This playermap now includes a **Broken Isles** tab (map 1220).
- Place your Legion world image at `img/map/brokenisles.jpg`.
- If markers are offset on your map image, tune `$map_legion_scale`, `$map_legion_offset_x`, and `$map_legion_offset_y` in `config/playermap_config.php`.
