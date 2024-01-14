<?php

class WelcomeController
{

    function __construct()
    {

    }

    public function render($twig)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('accueil.twig', ['user' => $_SESSION['user']]);
        } elseif (isset($_SESSION['admin'])) {
            echo $twig->render('accueil.twig', ['admin' => $_SESSION['admin']]);
        } else {
            echo $twig->render('accueil.twig');
        }
    }

}