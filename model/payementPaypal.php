<?php

require_once "order.php";

saveOrder("paypal");

header("Location: https://www.paypal.com/fr/home");

exit();