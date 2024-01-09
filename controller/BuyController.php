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
        } else {
            echo $twig->render('buy.twig', ['product' => $product]);
        }
    }

    public function render_bis($twig)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('addedToCart.twig', ['user' => $_SESSION['user']]);
        } else {
            echo $twig->render('addedToCart.twig');
        }
    }
}