<?php

session_start();


if(isset($_POST)){
    $_SESSION['adress'] = array($_POST['city'], $_POST['postcode'], $_POST['adress']);

}

header("Location: ../public/?page=payment");
