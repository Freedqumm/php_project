<?php

class ProductsController
{

    function __construct()
    {

    }

    public function render($twig, $type)
    {
        switch ($type) {
            case 'biscuits':
                $products = getBiscuits();
                session_start();
                if (isset($_SESSION['user'])) {
                    echo $twig->render('Products.twig', ['user' => $_SESSION['user'], 'products' => $products]);
                } else {
                    echo $twig->render('Products.twig', ['products' => $products]);
                }
                break;
            case 'boissons':
                $products = getBoissons();
                session_start();
                if (isset($_SESSION['user'])) {
                    echo $twig->render('Products.twig', ['user' => $_SESSION['user'], 'products' => $products]);
                } else {
                    echo $twig->render('Products.twig', ['products' => $products]);
                }
                break;
            case 'fruits':
                $products = getFruits();
                session_start();
                if (isset($_SESSION['user'])) {
                    echo $twig->render('Products.twig', ['user' => $_SESSION['user'], 'products' => $products]);
                } else {
                    echo $twig->render('Products.twig', ['products' => $products]);
                }
                break;
            default:
                echo $twig->render('error.twig');
        }
    }

}