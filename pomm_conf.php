<?php
require_once("func.php");

require_once("config/playermap_config.php");
require_once 'libs/data_lib.php';

define('MAP_REMOTE_IMAGE_BASE_DEFAULT', 'https://wow.zamimg.com/images/wow/maps/enus/original/');


//$realm_id = intval( $_COOKIE['cur_selected_realmd'] );
$server_arr = $server;

$realm_id = isset($_COOKIE['cur_selected_realmd']) ? intval($_COOKIE['cur_selected_realmd']) : 1;
if(!isset($server_arr[$realm_id]))
  $realm_id = 1; // Safe fallback realm_id

if (isset($_COOKIE["lang"]))
{
  $lang = "en";
  if (!file_exists("map_".$lang.".php") && !file_exists("zone_names_".$lang.".php"))
  {$lang = $language;}
}
else {$lang = $language;}


$database_encoding = preg_match('/^[a-zA-Z0-9_\\-]+$/', $site_encoding) ? $site_encoding : 'utf8';

$server = $server_arr[$realm_id]["addr"];
$port = $server_arr[$realm_id]["game_port"];

$host = $characters_db[$realm_id]["addr"];
$user = $characters_db[$realm_id]["user"];
$password = $characters_db[$realm_id]["pass"];
$db = $characters_db[$realm_id]["name"];

$hostr = $realm_db["addr"];
$userr = $realm_db["user"];
$passwordr = $realm_db["pass"];
$dbr = $realm_db["name"];

$sql = new DBLayer($hostr, $userr, $passwordr, $dbr);
$query = $sql->query("SELECT name FROM realmlist WHERE id = ".$realm_id);
$realm_name = $sql->fetch_assoc($query);
$realm_name = htmlspecialchars($realm_name["name"], ENT_QUOTES, 'UTF-8');

$gm_show_online = $gm_online;
$gm_show_online_only_gmoff = $map_gm_show_online_only_gmoff;
$gm_show_online_only_gmvisible = $map_gm_show_online_only_gmvisible;
$gm_add_suffix = $map_gm_add_suffix;
$gm_include_online = $gm_online_count;
$show_status = $map_show_status;
$time_to_show_uptime = $map_time_to_show_uptime;
$time_to_show_maxonline = $map_time_to_show_maxonline;
$time_to_show_gmonline = $map_time_to_show_gmonline;
$status_gm_include_all = $map_status_gm_include_all;
$time = $map_time;
$show_time = $map_show_time;

// points located on these maps(do not modify it)
$maps_for_points = "0,1,530,571,609,870,1116,1220";

$img_base = "img/map/";
$img_base2 = "img/c_icons/";

$PLAYER_FLAGS       = CHAR_DATA_OFFSET_FLAGS;

// Broken Isles (Legion, map 1220) render tuning values.
// If markers look offset for your map asset, tune these values.
$map_pandaria_scale = isset($map_pandaria_scale) ? $map_pandaria_scale : 0.050000;
$map_pandaria_offset_x = isset($map_pandaria_offset_x) ? $map_pandaria_offset_x : 515;
$map_pandaria_offset_y = isset($map_pandaria_offset_y) ? $map_pandaria_offset_y : 475;

$map_draenor_scale = isset($map_draenor_scale) ? $map_draenor_scale : 0.050000;
$map_draenor_offset_x = isset($map_draenor_offset_x) ? $map_draenor_offset_x : 500;
$map_draenor_offset_y = isset($map_draenor_offset_y) ? $map_draenor_offset_y : 380;

function sanitize_map_img_int($value, $default)
{
  if (!isset($value))
    return $default;

  $intValue = intval($value);
  return $intValue >= 0 ? $intValue : $default;
}

function build_map_image_url($baseUrl, $zoneId, $phase, $fallbackZoneId)
{
  $zoneId = sanitize_map_img_int($zoneId, $fallbackZoneId);
  $phase = sanitize_map_img_int($phase, 0);

  if (!isset($baseUrl) || !is_string($baseUrl))
    $baseUrl = MAP_REMOTE_IMAGE_BASE_DEFAULT;

  if (strpos($baseUrl, MAP_REMOTE_IMAGE_BASE_DEFAULT) !== 0)
    $baseUrl = MAP_REMOTE_IMAGE_BASE_DEFAULT;

  return $baseUrl.$zoneId."-".$phase.".jpg";
}

$map_remote_image_base = isset($map_remote_image_base) ? $map_remote_image_base : MAP_REMOTE_IMAGE_BASE_DEFAULT;
$map_zone_image_default_phase = sanitize_map_img_int(isset($map_zone_image_default_phase) ? $map_zone_image_default_phase : null, 0);

$map_pandaria_zone_id = sanitize_map_img_int(isset($map_pandaria_zone_id) ? $map_pandaria_zone_id : null, 870);
$map_pandaria_phase = sanitize_map_img_int(isset($map_pandaria_phase) ? $map_pandaria_phase : null, 0);

$map_draenor_zone_id = sanitize_map_img_int(isset($map_draenor_zone_id) ? $map_draenor_zone_id : null, 5723);
$map_draenor_phase = sanitize_map_img_int(isset($map_draenor_phase) ? $map_draenor_phase : null, 0);

$map_legion_zone_id = sanitize_map_img_int(isset($map_legion_zone_id) ? $map_legion_zone_id : null, 7543);
$map_legion_phase = sanitize_map_img_int(isset($map_legion_phase) ? $map_legion_phase : null, 0);

$map_pandaria_image_url = build_map_image_url($map_remote_image_base, $map_pandaria_zone_id, $map_pandaria_phase, 870);
$map_draenor_image_url = build_map_image_url($map_remote_image_base, $map_draenor_zone_id, $map_draenor_phase, 5723);
$map_legion_image_url = build_map_image_url($map_remote_image_base, $map_legion_zone_id, $map_legion_phase, 7543);

$map_legion_scale = isset($map_legion_scale) ? $map_legion_scale : 0.040;
$map_legion_offset_x = isset($map_legion_offset_x) ? $map_legion_offset_x : 483;
$map_legion_offset_y = isset($map_legion_offset_y) ? $map_legion_offset_y : 366;

?>
