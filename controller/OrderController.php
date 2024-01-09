<?php

class OrderController
{

    public function render($twig)
    {

        if (isset($_SESSION['user'])) {
            echo $twig->render('adress.twig', ['user' => $_SESSION['user']]);
        } else {
            echo $twig->render('adress.twig');
        }
    }
}