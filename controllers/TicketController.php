<?php
require_once 'config/database.php';

class TicketController {
    private $db;

    public function __construct(){
        $this->db = (new Database())->connect();
    }

    // Simpan tiket ke database
    public function store($cart, $user_id){
        foreach($cart as $item){
            $code = 'TKT' . strtoupper(uniqid());

            $stmt = $this->db->prepare(
                "INSERT INTO tickets (user_id, event_id, ticket_code)
                 VALUES (?, ?, ?)"
            );
            $stmt->execute([$user_id, $item['id'], $code]);
        }

        // Kosongkan cart setelah checkout
        unset($_SESSION['cart']);
    }

        // Ambil tiket user
    public function getByUser($userId){
        $db = (new Database())->connect();

        $stmt = $db->prepare("
            SELECT t.*, e.title, e.location
            FROM tickets t
            JOIN events e ON e.id = t.event_id
            WHERE t.user_id = ?
            ORDER BY t.created_at DESC
        ");
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function checkout($cart, $user_id){
        $this->db->beginTransaction();

        // Hitung total
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        // Simpan order
        $stmt = $this->db->prepare(
            "INSERT INTO orders (user_id, total_amount, status)
            VALUES (?, ?, 'paid')"
        );
        $stmt->execute([$user_id, $total]);
        $orderId = $this->db->lastInsertId();

        // Simpan payment (simulasi)
        $stmt = $this->db->prepare(
            "INSERT INTO payments (order_id, gateway_tx_id, amount, status, paid_at)
            VALUES (?, ?, ?, 'paid', NOW())"
        );
        $stmt->execute([
            $orderId,
            'SIM-' . strtoupper(uniqid()),
            $total
        ]);

        // Simpan order_items + tickets
        foreach($cart as $item){
            // ORDER ITEMS (✔ ticket_type_id masuk)
            $stmt = $this->db->prepare(
                "INSERT INTO order_items 
                (order_id, event_id, ticket_type_id, quantity, unit_price)
                VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $orderId,
                $item['event_id'],
                $item['ticket_type_id'],
                $item['qty'],
                $item['price']
            ]);

            // TICKET
            $code = 'TKT-' . strtoupper(uniqid());
            $stmt = $this->db->prepare(
                "INSERT INTO tickets (user_id, event_id, ticket_code)
                VALUES (?, ?, ?)"
            );
            $stmt->execute([$user_id, $item['event_id'], $code]);
        }

        $this->db->commit();
        unset($_SESSION['cart']);
    }
}