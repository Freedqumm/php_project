<?php

session_start();
$bool = session_unset();
echo $bool;