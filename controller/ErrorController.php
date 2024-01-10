<?php

class ErrorController
{

    function __construct()
    {

    }
    public function render($twig)
    {

        echo $twig->render('error.twig');
    }

}