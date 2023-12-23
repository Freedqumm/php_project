<?php

class CartController
{

    public function render($twig)
    {
        session_start();
        
        echo $twig->render('cart.twig', ['cart' => $_SESSION['cart']]);


    }
}