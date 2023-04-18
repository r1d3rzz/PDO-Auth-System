<?php

require "../init.php";

if (!$_SESSION['user']) {
    redirect('/auth/login.php');
    die();
} else {
    unset($_SESSION['user']);
    redirect('/');
}
