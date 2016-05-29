<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 18:16
 */

require 'inc/ini.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password))
        header('Location: hotels.php');
}

if ($user->is_loggedin())
    header('Location: hotels.php');
else
    echo $twig->render('/admin/login.html.twig', array());