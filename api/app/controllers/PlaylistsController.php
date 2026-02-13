<?php
class PlaylistsController {

    // Retorna todas as playlists e vídeos
    public function getPlaylists() {
        return [
            "playlists" => [
                [
                    "id" => 1,
                    "title" => "Introdução",
                    "description" => "Começar do zero",
                    "created_at" => "2026-02-10 10:33:44",
                    "videos" => [
                        [
                            "id" => 1,
                            "playlist_id" => 1,
                            "title" => "Bem-vindo ao curso",
                            "video_url" => "https://videos.com/video1.mp4",
                            "duration" => 300
                        ],
                        [
                            "id" => 2,
                            "playlist_id" => 1,
                            "title" => "Primeiros Passos",
                            "video_url" => "https://videos.com/video2.mp4",
                            "duration" => 420
                        ]
                    ]
                ],
                [
                    "id" => 2,
                    "title" => "Avançado",
                    "description" => "Conteúdos mais técnicos",
                    "created_at" => "2026-02-10 10:33:44",
                    "videos" => [
                        [
                            "id" => 3,
                            "playlist_id" => 2,
                            "title" => "Técnicas Avançadas",
                            "video_url" => "https://videos.com/video3.mp4",
                            "duration" => 600
                        ],
                        [
                            "id" => 4,
                            "playlist_id" => 2,
                            "title" => "Projeto Final",
                            "video_url" => "https://videos.com/video4.mp4",
                            "duration" => 900
                        ]
                    ]
                ]
            ]
        ];
    }
}

