<?php

error_reporting(1);

function dd($data)
{
    echo "<pre/>";
    die(print_r($data, true));
}

$_SESSION['errors'] = [];
function setError($message)
{
    $_SESSION['errors'][] = $message;
}

function showError()
{
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = [];
    if (count($errors)) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}

function hasError()
{
    $errors = $_SESSION['errors'];
    if (count($errors)) {
        return true;
    }
    return false;
}

function redirect($path = "/")
{
    header("location: $path");
}

function inputEmpty($name, $message)
{
    if (empty($name)) {
        setError("Please Enter $message");
    }
}

function slug($name)
{
    return uniqid() . '-' . str_replace(" ", "-", strtolower($name));
}
