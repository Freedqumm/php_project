<?php

class CartController
{

    public function render($twig)
    {
        session_start();
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        echo $twig->render('cart.twig', ['cart' => $_SESSION['cart']]);


    }
}