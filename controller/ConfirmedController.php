<?php

class ConfirmedController
{

    function __construct()
    {

    }
    public function render($twig)
    {

        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('inscriptionConfirmed.twig', ['user' => $_SESSION['user']]);
        } elseif (isset($_SESSION['admin'])) {
            echo $twig->render('inscriptionConfirmed.twig', ['admin' => $_SESSION['admin']]);
        }else {
            echo $twig->render('inscriptionConfirmed.twig');
        }
    }



}