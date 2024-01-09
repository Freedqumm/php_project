<?php

class PaymentController
{

    public function render($twig)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('payment.twig', ['user' => $_SESSION['user']]);
        } else {
            echo $twig->render('payment.twig', ['cart' => $_SESSION['cart']]);
        }
    }
}