<?php

session_start();



try {   
    $db = new PDO(
        'mysql:host=localhost;dbname=web4shop;charset=utf8',
        'root'
    );

    // Removing old cart 
    $stmt = $db->prepare("DELETE FROM cart WHERE idClient = {$_SESSION['user']['id']} ");
    $stmt->execute();

    // Insertion of the new cart 
    foreach ($_SESSION['cart'] as $product) {
        $stmt = $db->prepare("INSERT INTO cart (idClient, idProduct, quantite) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user']['id'], $product['id'], $product['quantity']]);
    }

} catch (Exception $e) {
    echo ("Problem PDO" . $e->getMessage());
}

session_destroy();

header("Location: ../public/");
