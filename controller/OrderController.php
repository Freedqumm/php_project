<?php

class OrderController
{

    public function render($twig){

        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('adress.twig', ['user' => $_SESSION['user']]);
        } elseif (isset($_SESSION['admin'])) {
            echo $twig->render('adress.twig', ['admin' => $_SESSION['admin']]);
        }else {
            echo $twig->render('adress.twig');
        }
    }
}