<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 17:20
 */

include __DIR__ . '/../../inc/inc.php';

session_set_cookie_params(10800);
session_start();
$settings_array = $fpdo->from('settings')->fetchAll();
foreach($settings_array as $key => $val){
    $settings[$val['sysname']] = $val['value'];
}
$twig->addGlobal('settings', $settings);
$user = new Users();
if (!$user->is_loggedin() && $_SERVER['REQUEST_URI'] != '/admin/login.php')
    header('Location: login.php');
else {
    $user_info = $user->getUser();
    $twig->addGlobal('options', $user_info);
}


