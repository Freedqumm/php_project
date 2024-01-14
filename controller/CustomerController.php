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

        $adress = $_POST['adress'];

        $customerModel = new UserModel();
        $customerModel->saveCustomer($nom, $prenom, $email, $password, $numero, $adress, $code_postal, $ville);


        header('Location: ../public/?page=inscriptionConfirmed');
        exit();
    }

    public function processLogin()
    {
        // Vérifier si les indices 'email' et 'password' existent dans $_POST
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password = sha1($password);

            $userModel = new UserModel();
            $user = $userModel->getCustomerByEmail($email);

            // Stocker l'URL actuelle dans la session
            $_SESSION['redirect_url'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../public/?page=default';
            $redirectUrl = $_SESSION['redirect_url'];

            if (!empty($user)) {
                if ($password == $user['password']) {
                    session_start();
                    if ($email == "admin@gmail.com") {
                        $_SESSION['admin'] = $user;
                    } else {
                        $_SESSION['user'] = $user;
                    }
                    header('Location: ' . $redirectUrl);
                    exit();
                } else {
                    echo "Utilisateur ou mot de passe incorrect.";
                }
            } else {
                echo "Utilisateur ou mot de passe incorrect.";
            }
        } else {
            echo "Indices 'email' et/ou 'password' non définis dans \$_POST.";
        }
    }


    public function processLogout()
    {

        header('Location: ../model/storeCart.php');
        exit();
    }
}