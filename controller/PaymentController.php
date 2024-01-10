<?php

class PaymentController
{

    public function render($twig)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('payment.twig', ['user' => $_SESSION['user'], ['cart' => $_SESSION['cart']]]);
        } elseif (isset($_SESSION['admin'])) {
            echo $twig->render('payment.twig', ['admin' => $_SESSION['admin'],['cart' => $_SESSION['cart']]]);
        } else {
            echo $twig->render('payment.twig', ['cart' => $_SESSION['cart']]);
        }
    }
}