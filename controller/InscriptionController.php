<?php

class InscriptionController
{

    public static function creerComptePost($nom,$prenom,$email,$password,$numero,$ville,$postcode){



    }



    function __construct()
    {

    }


    public function render($twig)
    {

        echo $twig->render('inscription.twig');
    }
}
