<?php

require "../init.php";

if (!$_SESSION['user']) {
    return redirect("/auth/sign_up.php");
} else {
    $user = $_SESSION['user'];
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($_GET['username'] == $user->username) {
            query("delete from users where username=?", [$user->username]);
            unset($_SESSION['user']);
            echo "<script>alert('Goodbye fri...')</script>";
            echo "<script>location='/'</script>";
        } else {
            return redirect("/users/profile.php");
        }
    }
}
