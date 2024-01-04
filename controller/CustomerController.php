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

        $userModel = new UserModel();
        $user = $userModel->getCustomerByEmail($email);

        if ($user || password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_user_authenticated'] = true;
            header('Location: ../public/?page=default');
            exit();
        } else {
            echo "Identifiants invalides.";
        }
    }

    public function processLogout()
    {
        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil (ou une autre page après la déconnexion)
        header('Location: ../public/?page=default');
        exit();
    }
}