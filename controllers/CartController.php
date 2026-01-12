<?php
require_once __DIR__ . '/../models/Event.php';

class CartController {

    public function add(int $eventId, string $ticketType = 'reguler') {

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $eventModel = new Event();
        $event = $eventModel->find($eventId);

        if (!$event) {
            return;
        }

        // Tentukan harga berdasarkan jenis tiket
        $price = $event['price'];
        if ($ticketType === 'vip') {
            $price = $event['price'] * 2;
        }

        // Key unik: event_id + ticket_type
        $key = $eventId . '_' . $ticketType;

        if (isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['qty']++;
        } else {
            $_SESSION['cart'][$key] = [
                'event_id'    => $event['id'],
                'title'       => $event['title'],
                'ticket_type' => $ticketType,
                'price'       => $price,
                'qty'         => 1
            ];
        }
    }

    public function get() {
        return $_SESSION['cart'] ?? [];
    }

    public function clear() {
        unset($_SESSION['cart']);
    }
}
