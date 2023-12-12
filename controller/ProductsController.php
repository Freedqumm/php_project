<?php

class ProductsController
{

    function __construct()
    {

    }
    public function render($twig, $type)
    {
        switch($type){
            case 'biscuits':
                $products = getBiscuits();
                echo $twig->render('Products.twig', ['products' => $products]);
                break;
            case 'boissons':
                $products = getBoissons();
                echo $twig->render('Products.twig', ['products' => $products]);
                break;
            case 'fruits':
                $products = getFruits();
                echo $twig->render('Products.twig', ['products' => $products]);
                break;
            default:
                echo $twig->render('error.twig');
        }
    }

}