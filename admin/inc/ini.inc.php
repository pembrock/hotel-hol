<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 17:20
 */

include __DIR__ . '/../../inc/inc.php';

ini_set('session.gc_maxlifetime', 3600*24*30);
ini_set('session.cookie_lifetime', 3600*24*30);
session_start();
$settings_array = $fpdo->from('settings')->fetchAll();
foreach($settings_array as $key => $val){
    $settings[$val['sysname']] = $val['value'];
}
$lang = $fpdo->from('language')->fetchAll();
$twig->addGlobal('settings', $settings);
$twig->addGlobal('lang', $lang);
$user = new Users();
if (!$user->is_loggedin() && $_SERVER['REQUEST_URI'] != '/admin/login.php')
    header('Location: login.php');
else {
    $user_info = $user->getUser();
    $twig->addGlobal('options', $user_info);
}


