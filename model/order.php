<?php
require_once "UserModel.php";

function saveOrder($type)
{

    session_start();

    // Calcul total panier
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $total += $product['price'] * $product['quantity'];
        }
    }

    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root'
        );

        // Ajout de la commande dans la BD
        $stmt = $db->prepare("INSERT INTO orders (customer_id, registered, delivery_add_id, payment_type, date, status, session, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if (isset($_SESSION['user'])) {
            $stmt->execute([$_SESSION['user']['id'], 1, 0, $type, date('Y-m-d'), 0, "session", $total]);
        } else {

            // Creation d'un id client virtuel
            $usermodel = new UserModel();
            $usermodel->saveCustomer(session_id(), "none", "none", "none", "none", $_SESSION['adress'][1], $_SESSION['adress'][0]);

            // Récupération de l'id de l'utilisateur virtuel 
            $sessionId = session_id();
            $query = $db->prepare("SELECT id FROM customers WHERE surname = :userName");
            $query->bindParam(':userName', $sessionId, PDO::PARAM_STR);
            $query->execute();
            $id = $query->fetchAll();

            $id = $id[0]['id'];
            
            $stmt->execute([$id, 0, 0, $type, date('Y-m-d'), 0, "", $total]);
        }

        // Ajout de chaque produit dans la BD
        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];
            $stmt = $db->prepare("SELECT id FROM orders WHERE customer_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $id = $stmt->fetch();
        } else {
            // Récupération de l'id de 
            $sessionId = session_id();
            $query = $db->prepare("SELECT id FROM customers WHERE surname = :userName");
            $query->bindParam(':userName', $sessionId, PDO::PARAM_STR);
            $query->execute();
            $id = $query->fetchAll();
            $id = $id[0]['id'];

            $stmt = $db->prepare("SELECT id FROM orders WHERE customer_id = :userId");
            $stmt->bindParam(':userId', $id, PDO::PARAM_INT);
            $stmt->execute();
            $id = $stmt->fetch();
            $id = $id['id'];

        }

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product) {

                $stmt = $db->prepare("INSERT INTO orderitems (order_id, product_id, quantity)  VALUES (?, ?, ?) ");
                $stmt->execute([$id, $product['id'], $product['quantity']]);
            }
        }

    } catch (Exception $e) {
        echo ("Problem PDO" . $e->getMessage());
    }
}