<?php
// === Incluir controladores da API usando caminhos absolutos ===
require_once __DIR__ . "/app/controllers/EventsController.php";
require_once __DIR__ . "/app/controllers/PlaylistsController.php";

// === Criar instâncias dos controladores ===
$eventsCtrl = new EventsController();
$playlistsCtrl = new PlaylistsController();

// === Obter dados da API ===
$events_data = $eventsCtrl->getEvents();          // array com 'events'
$playlists_data = $playlistsCtrl->getPlaylists(); // array com 'playlists'

// === Garantir que existem para evitar warnings ===
$events_data = $events_data ?? ["events"=>[]];
$playlists_data = $playlists_data ?? ["playlists"=>[]];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Victus</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
  <div class="container">
    <h1>Dashboard</h1>

    <!-- Eventos -->
    <section class="events">
      <h2>Eventos</h2>
      <?php if (!empty($events_data['events'])): ?>
        <?php foreach($events_data['events'] as $event): ?>
          <div class="event-card">
            <h3><?= $event['title'] ?></h3>
            <p><?= date("d M · H:i", strtotime($event['event_date'])) ?></p>
            <a href="<?= $event['meeting_link'] ?>">Acessar link</a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Nenhum evento disponível.</p>
      <?php endif; ?>
    </section>

    <!-- Biblioteca -->
    <section class="library-preview">
      <h2>Biblioteca</h2>
      <?php if (!empty($playlists_data['playlists'])): ?>
        <?php foreach($playlists_data['playlists'] as $playlist): ?>
          <div class="playlist-card">
            <h3><?= $playlist['title'] ?></h3>
            <?php foreach($playlist['videos'] as $video): ?>
              <div class="video-item">
                <span>▶</span> <?= $video['title'] ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Nenhuma playlist disponível.</p>
      <?php endif; ?>
    </section>
  </div>
</body>
</html>
