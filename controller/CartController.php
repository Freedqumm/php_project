<?php

class CartController
{

    public function render($twig)
    {
        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['user'])) {
            echo $twig->render('cart.twig', ['cart' => $_SESSION['cart'], 'user' => $_SESSION['user']]);
        } else {
            echo $twig->render('cart.twig', ['cart' => $_SESSION['cart']]);
        }

    }
}