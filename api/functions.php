<?php
require_once "app/controllers/VideoProgressController.php";
require_once "app/controllers/FavoritesController.php";
require_once "app/controllers/EventsController.php"; // se existir
require_once "app/controllers/PlaylistsController.php"; // se existir

use App\Controllers\VideoProgressController;
use App\Controllers\FavoritesController;
use App\Controllers\EventsController;
use App\Controllers\PlaylistsController;

$progressCtrl = new VideoProgressController();
$favCtrl = new FavoritesController();
$eventsCtrl = new EventsController();
$playlistsCtrl = new PlaylistsController();

function getDashboardData($user_id = 1) {
    global $progressCtrl, $favCtrl, $eventsCtrl, $playlistsCtrl;

    return [
        "events" => $eventsCtrl->getAll(),
        "playlists" => $playlistsCtrl->getAll(),
        "progress" => $progressCtrl->getProgress($user_id),
        "favorites" => $favCtrl->getFavorites($user_id)
    ];
}
