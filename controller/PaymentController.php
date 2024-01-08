<?php

class PaymentController{

    public function render($twig){
        session_start();
        echo $twig->render('payment.twig', ['cart' => $_SESSION['cart']]);
    }
}