<?php

require_once '../model/UserModel.php';

class CustomerController
{
    public function __construct()
    {
    }

    public function showRegistrationForm($twig)
    {
        echo $twig->render('Inscription.twig');
    }

    public function processRegistration()
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $numero = $_POST['numero'];
        $code_postal = $_POST['code_postal'];
        $ville = $_POST['ville'];

        $customerModel = new UserModel();
        $customerModel->saveCustomer($nom, $prenom, $email, $password, $numero, $code_postal, $ville);

        header('Location: ../public/?page=inscriptionConfirmed');
        exit();
    }

    public function processLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = sha1($password);

        $userModel = new UserModel();
        $user = $userModel->getCustomerByEmail($email);

        if (!empty($user)) {
            echo "Utilisateur trouvé : ";
            var_dump($user);
            if ($password == $user['password']) {
                session_start();
                if ($email == "admin@gmail.com") {
                    $_SESSION['admin'] = $user;
                } else {
                    $_SESSION['user'] = $user;
                }
                header('Location: ../public/?page=default');
                exit();
            } else {
                echo "Mot de passe incorrect. Voici ce que tu as entré : $password";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    }


    public function processLogout()
    {
        
        header('Location: ../model/storeCart.php');
        exit();
    }
}