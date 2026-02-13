<?php
class EventsController {

    // Retorna todos os eventos
    public function getEvents() {
        // Simulação de dados, mais tarde podes buscar direto da BD
        return [
            "events" => [
                [
                    "id" => 1,
                    "title" => "Sessão de Boas-vindas",
                    "description" => "Apresentação do curso",
                    "event_date" => "2026-02-12 18:00:00",
                    "meeting_link" => "https://meet.com/abc",
                    "created_at" => "2026-02-10 10:32:12"
                ],
                [
                    "id" => 2,
                    "title" => "Workshop Avançado",
                    "description" => "Sessão prática",
                    "event_date" => "2026-02-20 19:00:00",
                    "meeting_link" => "https://meet.com/xyz",
                    "created_at" => "2026-02-10 10:32:12"
                ]
            ]
        ];
    }
}
