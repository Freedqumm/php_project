<?php

class BuyController
{

    function __construct()
    {

    }
    public function render($twig, $id)
    {
        $product = getProduct($id);

        echo $twig->render('buy.twig', ['product' => $product]);
    }

    public function render_bis($twig){
        echo $twig->render('addedToCart.twig');
    }

}