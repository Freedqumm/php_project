<?php

class ListOrderController
{
    function __construct()
    {

    }

    public function render($twig)
    {
        $result = getCart();
        $cartData = $result;

        session_start();
        if (isset($_SESSION['admin'])) {
            echo $twig->render('ListOrder.twig', ['admin' => $_SESSION['admin'], 'cartData' => $cartData]);
        } else {
            echo $twig->render('error.twig');
        }
    }
}