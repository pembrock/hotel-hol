<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 15:50
 */

require 'inc.php';

if(isset($_POST['language']))
{
    $array = array("type" => $_POST['lang'], "alt" => $_POST['alt'], "title" => $_POST['title']);
    $value = serialize($array);


    setcookie('lang', $value, time() + 3600 * 7);
    die();
}
if(isset($_COOKIE['lang']))
    $lang = unserialize($_COOKIE['lang']);
else
    $lang = array("type" => 'ru', "alt" => 'Russian', "title" => 'Russian (ru)');
$lang_array = $fpdo->from('language')->where(array('isActive' => 1))->fetchAll();
$language = array();
foreach($lang_array as $key)
{
    $language[$key['code']]['alt'] = $key['name'];
    $language[$key['code']]['title'] = $key['name'] . ' (' . $key['code'] . ')';
}
unset($language[$lang['type']]);
//$lang = $_COOKIE['lang'];
$settings_array = $fpdo->from('settings')->fetchAll();
foreach($settings_array as $key => $val){
    //foreach($val as $v)
    $settings[$val['sysname']] = $val['value'];
}
$twig->addGlobal('lang', $lang);
$twig->addGlobal('language', $language);
$twig->addGlobal('settings', $settings);
$hotels = $fpdo->from('hotel')->orderBy('orderBy')->fetchAll();
$promo = $fpdo->from('promo')->where(array('isActive' => 1))->fetchAll();
if (isset($_SERVER['REDIRECT_URL']) && $_SERVER['REDIRECT_URL'] != '/hotels') {
    $meta = $fpdo->from('search')->where(array('page' => str_replace('/', '', $_SERVER['REDIRECT_URL'])))->fetchAll();
    $meta_desc = $meta[0]['meta_desc'];
    $meta_key = $meta[0]['meta_key'];
}
else if($_SERVER['REQUEST_URI'] == '/')
{
    $meta = $fpdo->from('search')->where(array('page' => 'main'))->fetchAll();
    $meta_desc = $meta[0]['meta_desc'];
    $meta_key = $meta[0]['meta_key'];
}
if (isset($meta_key, $meta_desc))
{
    $twig->addGlobal('metadesc', $meta_desc);
    $twig->addGlobal('metakey', $meta_key);
}
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