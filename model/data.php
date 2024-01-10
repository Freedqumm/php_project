<?php

function getBiscuits()
{
    try {
            $db = new PDO(
            'mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root'
        );
    } catch (Exception $e) {
        echo 'PDO problem';
    }

    $query = $db->prepare('SELECT * FROM PRODUCTS WHERE cat_id = 2');
    $query->execute();
    $products = $query->fetchAll();

    return $products;
}

function getBoissons()
{
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root'
        );
    } catch (Exception $e) {
        echo 'PDO problem';
    }

    $query = $db->prepare('SELECT * FROM PRODUCTS WHERE cat_id = 1');
    $query->execute();
    $products = $query->fetchAll();


    return $products;
}

function getFruits()
{
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root'
        );
    } catch (Exception $e) {
        echo 'PDO problem';
    }

    $query = $db->prepare('SELECT * FROM PRODUCTS WHERE cat_id = 3');
    $query->execute();
    $products = $query->fetchAll();

    return $products;
}

function getProduct($id){
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root'
        );
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    $query = $db->prepare("SELECT * FROM PRODUCTS WHERE id = $id ");
    $query->execute();
    $products = $query->fetchAll();

    return $products;
}

function getCart() {
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root'
        );
    } catch (Exception $e) {
        echo 'PDO problem';
    }

    // Récupérer les informations des commandes
    $queryOrders = $db->prepare('SELECT * FROM ORDERS');
    $queryOrders->execute();
    $orders = $queryOrders->fetchAll();

    // Récupérer les informations des articles commandés
    $queryOrderItems = $db->prepare('SELECT * FROM ORDERITEMS');
    $queryOrderItems->execute();
    $orderItems = $queryOrderItems->fetchAll();

    // Récupérer les IDs de toutes les commandes
    $queryOrderIDs = $db->prepare('SELECT order_id FROM ORDERITEMS');
    $queryOrderIDs->execute();
    $orderIDs = $queryOrderIDs->fetchAll(PDO::FETCH_COLUMN);

    // Construire un tableau associatif avec les détails des commandes et des articles commandés
    $cartData = [];
    foreach ($orderIDs as $orderID) {
        $cartData[$orderID]['order'] = array_filter($orders, function($order) use ($orderID) {
            return $order['id'] == $orderID;
        });

        $cartData[$orderID]['orderItems'] = array_filter($orderItems, function($orderItem) use ($orderID) {
            return $orderItem['order_id'] == $orderID;
        });

        $productIDs = array_column($cartData[$orderID]['orderItems'], 'product_id');
        $productIDsStr = implode(',', $productIDs);

        $queryProducts = $db->prepare("SELECT id, name FROM PRODUCTS WHERE id IN ($productIDsStr)");
        $queryProducts->execute();
        $products = $queryProducts->fetchAll();

        // Associer les détails des produits à la commande
        $cartData[$orderID]['products'] = $products;
    }

    return $cartData;
}



