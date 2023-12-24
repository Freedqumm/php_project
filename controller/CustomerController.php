<?php

require_once '../model/UserModel.php';
class CustomerController
{
    public function __construct()
    {
        session_start();
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
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

        $customerModel = new UserModel();
        $customer = $customerModel->getCustomerByEmail($email);

        if ($customer && password_verify($password, $customer['password'])) {
            $_SESSION['user_id'] = $customer['id'];
            $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '../public/?page=accueil';
            unset($_SESSION['redirect_url']); // Effacer l'URL stockée dans la session
            header('Location: ' . $redirect_url);
            exit();
        } else {
            echo "Identifiants invalides.";
        }
    }
}