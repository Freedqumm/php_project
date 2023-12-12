<?php

class WelcomeController
{

    function __construct()
    {

    }
    public function render($twig)
    {

        echo $twig->render('accueil.twig');
    }

}