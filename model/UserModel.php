<?php
class UserModel
{
    public function saveCustomer($nom, $prenom, $email, $password, $numero, $adress, $code_postal, $ville)
    {
        $registered = 1;
        $password = sha1($password);
        $pdo = new PDO('mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root');
        $stmt = $pdo->prepare("INSERT INTO customers (surname, forname, email, password, phone, adress, postcode, ville, registered) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $password, $numero, $adress, $code_postal, $ville, $registered]);
    }

    public function getCustomerByEmail($email)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=web4shop;charset=utf8',
            'root');
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}