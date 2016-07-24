<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 17:50
 */

include __DIR__ . '/../../inc/inc.php';
class Users
{

    public function login($email, $password)
    {
        global $fpdo;
        $query = $fpdo->from('Users')
                    ->where(array('Email' => $email, 'Password' => md5($password)));
        if($query) {
            $row = $query->fetch();
            $_SESSION['user_auth'] = $row['ID'];
            return true;
        }


    }

    public function is_loggedin()
    {
        if (isset($_SESSION['user_auth']))
        {
            return true;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: login.php');
    }

    public function getUser()
    {
        global $fpdo;
        if (isset($_SESSION['user_auth'])) {
            $query = $fpdo->from('Users')
                ->select(null)
                ->select(array('id', 'Username'))
                ->where(array('id' => $_SESSION['user_auth']));
            return $query->fetch();
        }
    }

}