<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'decrement' || $action === 'increment') {
                // Mise à jour de la quantité du produit dans le panier
                updateQuantity($productId, $action);
            } elseif ($action === 'delete') {
                // Suppression du produit du panier
                removeProduct($productId);
            }


            // Redirection vers la page du panier ou une autre page
            header("Location: ../public/?page=cart");
            exit();
        }
    }

    #header("Location: ../public/?page=cart");
}

// Fonction pour mettre à jour la quantité d'un produit dans le panier
function updateQuantity($productId, $action)
{
    $index = array_search($productId, array_column($_SESSION['cart'], 'id'));

    if ($index !== false) {
        if ($_SESSION['cart'][$index]['quantity'] > 0) {
            $_SESSION['cart'][$index]['quantity'] += ($action === 'increment') ? 1 : -1;
        }
    }
}


// Fonction pour supprimer un produit du panier
function removeProduct($productId)
{
    if (isset($_SESSION['cart'])) {
        $index = array_search($productId, array_column($_SESSION['cart'], 'id'));
        if ($index !== false) {
            unset($_SESSION['cart'][$index]);
        }

    }
}
