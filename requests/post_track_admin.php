<?php
require_once(__DIR__ .'/../includes/autoload.php');

if(!isset($_SESSION['token_id'])) {
    return false;
}



$feed = new feed();
$feed->db = $db;
$feed->url = $CONF['url'];
// $feed->id = $user['idu'];
$feed->username = $user['adminUsername'] ?? $_SESSION['adminUsername'];
$feed->per_page = $settings['perpage'];
$feed->art_size = $settings['artsize'];
$feed->art_format = $settings['artformat'];
$feed->track_size_total = $settings['tracksizetotal'] ?? '';
$feed->track_size = $settings['tracksize'] ?? '';
$feed->track_format = $settings['trackformat'];
$feed->time = $settings['time'];
	
$update = $feed->updateTrack($_POST, 1);

mysqli_close($db);

$TMPL['message'] = 12312;

$skin = new skin('admin/track');

return $skin->make();
?>