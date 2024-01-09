<?php

require_once "data.php";

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


try {
    $db = new PDO(
        'mysql:host=localhost;dbname=web4shop;charset=utf8',
        'root'
    );
    // Getting the cart saved in the DB in $_SESSION
    $id = $_SESSION['user']['id'];
    $query = $db->prepare("SELECT idProduct, quantite FROM cart WHERE idClient = $id");
    $query->execute();
    $cart = $query->fetch(PDO::FETCH_ASSOC);
    
    print_r($cart);
    if (!is_bool($cart)) {
        $product = getProduct($cart['idProduct']);
        foreach ($cart as $product) {
            $item = getProduct($cart['idProduct']);
            $item = $item[0];
            $_SESSION['cart'][] = array('id' => $item['id'], 'name' => $item['name'], 'image' => $item['image'], 'price' => $item['price'], 'quantity' => $cart['quantite']);
        }
    }
    
} catch (Exception $e) {
    echo ("Problem PDO");
}




//header("Location: ../public/?page=default");
