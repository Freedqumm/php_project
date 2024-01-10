<?php

class BuyController
{

    function __construct()
    {

    }

    public function render($twig, $id)
    {
        $product = getProduct($id);

        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('buy.twig', ['user' => $_SESSION['user'], 'product' => $product]);
        } elseif (isset($_SESSION['admin'])) {
            echo $twig->render('buy.twig', ['admin' => $_SESSION['admin'], 'product' => $product]);
        } else {
            echo $twig->render('buy.twig', ['product' => $product]);
        }
    }

    public function render_bis($twig)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('addedToCart.twig', ['user' => $_SESSION['user']]);
        }elseif (isset($_SESSION['admin'])) {
            echo $twig->render('addedToCart.twig', ['admin' => $_SESSION['admin']]);
        } else {
            echo $twig->render('addedToCart.twig');
        }
    }
}