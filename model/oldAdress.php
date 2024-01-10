<?php

session_start();

$_SESSION['adress'] = array($_SESSION['user']['ville'], $_SESSION['user']['postcode'], $_SESSION['user']['add2']);

header("Location: ../public/?page=payment");
