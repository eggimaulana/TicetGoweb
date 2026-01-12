<?php
require_once __DIR__ . '/../config/Database.php';

class OrderController {

    public function checkout($userId){
        if (empty($_SESSION['cart'])) {
            return false;
        }

        $db = (new Database())->connect();

        // HITUNG TOTAL
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // INSERT ORDER
        $stmt = $db->prepare(
            "INSERT INTO orders (user_id, total, status, created_at)
            VALUES (?, ?, 'paid', NOW())"
        );
        $stmt->execute([$userId, $total]);
        $orderId = $db->lastInsertId();

        // INSERT ORDER ITEMS
        $stmtItem = $db->prepare(
            "INSERT INTO order_items (order_id, event_id, qty, price)
            VALUES (?, ?, ?, ?)"
        );

        // INSERT TICKETS
        $stmtTicket = $db->prepare(
            "INSERT INTO tickets (user_id, event_id, order_id, ticket_code, created_at)
            VALUES (?, ?, ?, ?, NOW())"
        );

        foreach ($_SESSION['cart'] as $item) {

            // order_items
            $stmtItem->execute([
                $orderId,
                $item['event_id'],
                $item['qty'],
                $item['price']
            ]);

            // tickets (buat sesuai qty)
            for ($i = 0; $i < $item['qty']; $i++) {
                $ticketCode = 'TKT-' . strtoupper(uniqid());
                $stmtTicket->execute([
                    $userId,
                    $item['event_id'],
                    $orderId,
                    $ticketCode
                ]);
            }
        }

        unset($_SESSION['cart']);
        return true;
    }

    public function getByUser($userId){
        $db = (new Database())->connect();

        $stmt = $db->prepare("
            SELECT id, user_id, total, status, created_at
            FROM orders
            WHERE user_id = ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

