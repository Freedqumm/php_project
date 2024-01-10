<?php

session_start();

// Calcul total panier
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $total += $product['price'] * product['quantity'];
    }
}

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=web4shop;charset=utf8',
        'root'
    );

    // Ajout de la commande dans la BD
    $stmt = $db->prepare("INSERT INTO orders (customer_id, registered, delivery_add_id, payment_type, date, status, session, total) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (isset($_SESSION['user'])) {
        $stmt->execute([$_SESSION['user']['id'], 1, 0, "chèque", date('Y-m-d'), 0, "", $total]);
    } else {
        $stmt->execute([0, 0, 0, "chèque", date('Y-m-d'), 0, "", $total]);
    }

    // Ajout de chaque produit dans la BD

    $stmt = $db->prepare("SELECT id FROM orders WHERE customer_id = {$_SESSION['user']['id']}");
    $stmt->execute();
    $id = $stmt->fetch();

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {

            $stmt = $db->prepare("INSERT INTO orderitems (order_id, product_id, quantity)  VALUES (?, ?, ?) ");
            $stmt->execute([$id, $product['id'], $product['quantity']]);
        }
    }

} catch (Exception $e) {
    echo ("Problem PDO" . $e->getMessage());
}