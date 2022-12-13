<?php

session_start();
unset($_SESSION['login']);
// unset($_SESSION['access']);

echo header("Location: login.php");