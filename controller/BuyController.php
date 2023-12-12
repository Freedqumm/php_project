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

}