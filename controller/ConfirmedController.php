<?php

class ConfirmedController
{

    function __construct()
    {

    }
    public function render($twig)
    {

        echo $twig->render('inscriptionConfirmed.twig');
    }



}