<?php

class OrderCompletedController{
    public function __construct()
    {
    }

    public function render($twig){
        session_start();
        if (isset($_SESSION['user'])) {
            echo $twig->render('orderCompleted.twig', ['user' => $_SESSION['user']]);
        } elseif (isset($_SESSION['admin'])) {
            echo $twig->render('orderCompleted.twig', ['admin' => $_SESSION['admin']]);
        }else {
            echo $twig->render('orderCompleted.twig');
        }
    }

    public function confirm_order()
    {
        // Récupérer l'ID de la commande à partir de la requête POST
        $orderId = $_POST['order_id'];

        try {
            $db = new PDO(
                'mysql:host=localhost;dbname=web4shop;charset=utf8',
                'root'
            );
        } catch (Exception $e) {
            echo 'PDO problem';
            // Gérer l'erreur de connexion à la base de données
            exit;
        }

        // Mettre à jour la commande pour la marquer comme confirmée
        $queryUpdateOrder = $db->prepare('UPDATE ORDERS SET confirmed = 1 WHERE id = :orderId');
        $queryUpdateOrder->bindParam(':orderId', $orderId, PDO::PARAM_INT);

        if ($queryUpdateOrder->execute()) {
            // Rediriger vers la page des commandes après la confirmation
            header('Location: ../public/?page=listorder');
            exit;
        } else {
            // Gérer l'erreur de mise à jour de la commande
            echo 'Error updating order status';
            exit;
        }
    }}