<?php
require_once(__DIR__ .'/../includes/autoload.php');

if(!isset($_SESSION['token_id'])) {
    return false;
}

global $TMPL, $LNG, $CONF, $db, $settings;

$manageTracks = new manageTracks();

$manageTracks->db = $db;
$manageTracks->per_page = $settings['rperpage'];

$users = $manageTracks->getUserAdmin(0);

$manageTracks->id = $_REQUEST['id'];
$manageTracks->url = $CONF['url'];
$manageTracks->user = $users[0];
$manageTracks->user_id = $users[0]['id'];
$manageTracks->username = $users[0]['username'] ?? $_SESSION['adminUsername'];
$manageTracks->per_page = $settings['perpage'];
$manageTracks->art_size = $settings['artsize'];
$manageTracks->art_format = $settings['artformat'];
$manageTracks->track_size_total = $settings['tracksizetotal'] ?? '';
$manageTracks->track_size = $settings['tracksize'] ?? '';
$manageTracks->track_format = $settings['trackformat'];
$manageTracks->time = $settings['time'];
	
$update = $manageTracks->updateTrack($_POST, 1);

echo json_encode(array("result" => (strpos($update[0], 'notification-box-error') > 0 ? 0 : 1), "message" => $update[0]));

mysqli_close($db);
?>