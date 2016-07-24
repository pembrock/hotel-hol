<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 15:50
 */

require 'inc.php';

$settings_array = $fpdo->from('settings')->fetchAll();
foreach($settings_array as $key => $val){
    //foreach($val as $v)
    $settings[$val['sysname']] = $val['value'];
}
$twig->addGlobal('settings', $settings);
$hotels = $fpdo->from('hotel')->orderBy('orderBy')->fetchAll();
$promo = $fpdo->from('promo')->where(array('isActive' => 1))->fetchAll();
$twig->addGlobal('hotels', $hotels);
$twig->addGlobal('promo', $promo);

$url = /*$_SERVER['REQUEST_SCHEME'] . */'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parse_url = parse_url($url);

$page = $config['path']['pages'] .  ($_SERVER['REQUEST_URI'] == '/' ? '/main.php' : $parse_url['path'] . '.php');

if (file_exists($page))
    include "$page";
else {
    header('HTTP/1.0 404 Not Found');
    readfile('templates/404.html');
    }