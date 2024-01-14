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
            echo $twig->render('cart.twig', ['user' => $_SESSION['user'], 'cart' => $_SESSION['cart']]);
        } elseif (isset($_SESSION['admin'])) {
            echo $twig->render('cart.twig', ['admin' => $_SESSION['admin'], 'cart' => $_SESSION['cart']]);
        }else {
            echo $twig->render('cart.twig', ['cart' => $_SESSION['cart']]);
        }
    }
}