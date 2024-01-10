<?php

class OrderCompletedController{
    
    public function render($twig){


        echo $twig->render("orderCompleted.twig");
    }
}