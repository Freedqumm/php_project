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
        } else {
            echo $twig->render('accueil.twig');
        }
    }

}