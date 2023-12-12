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