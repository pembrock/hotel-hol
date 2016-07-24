<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 15:50
 */

require 'inc.php';
$url = /*$_SERVER['REQUEST_SCHEME'] . */'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$parse_url = parse_url($url);
$parse_url['path'] = preg_replace('/^\/(\D{2})\//', '/', $parse_url['path']);
$base_url = $parse_url['scheme'] . "://" . $parse_url['host'] . '/' . $_GET['lang'];
$lang_array = $fpdo->from('language')->where(array('isActive' => 1))->fetchAll();
$language = array();
foreach($lang_array as $key)
{
    $language[$key['code']]['type'] = $key['code'];
    $language[$key['code']]['alt'] = $key['name'];
    $language[$key['code']]['title'] = $key['name'] . ' (' . $key['code'] . ')';

}

if(isset($_POST['language']))
{
    $array = array("type" => $_POST['lang'], "alt" => $_POST['alt'], "title" => $_POST['title']);
    $value = serialize($array);

    setcookie('lang', $value, time() + 3600 * 7);
    echo $parse_url['scheme'] . "://" . $parse_url['host'] . '/' . $_POST['lang'] . $parse_url['path'] . (isset($parse_url['query']) ? '?' . $parse_url['query'] : '');
    die();
}
if(isset($_GET['lang']))
    $lang = $language[$_GET['lang']];
//else
//    $lang = array("type" => 'ru', "alt" => 'Russian', "title" => 'Russian (ru)');

$titles_arr = $fpdo->from('titles')->select(null)->select($lang['type'] . ' AS value, system')->fetchAll();
$titles = array();
foreach ($titles_arr as $t){
    $titles[$t['system']] = $t['value'];
}

$lang['currency'] = "&#8381;";


//unset($language[$lang['type']]);

$settings_array = $fpdo->from('settings')->fetchAll();
foreach($settings_array as $key => $val){
    //foreach($val as $v)
    $settings[$val['sysname']] = $val['value'];
}
$query = $fpdo->from('menu')->select(null)->select('menu.id, menu.title_' . $lang["type"] . ' AS title, menu.code')->where(array('isActive' => 1));
$menu = $query->fetchAll();
$twig->addGlobal('lang', $lang);
$twig->addGlobal('menu', $menu);
$twig->addGlobal('language', $language);
$twig->addGlobal('settings', $settings);
$twig->addGlobal('titles', $titles);
$twig->addGlobal('base_url', $base_url);


$hotels = $fpdo->from('hotel')->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description, logo, phone, phone2, email, address_' . $lang['type'] . ' AS address, subway_' . $lang['type'] . ' AS subway, maps_link, address_description_' . $lang['type'] . ' AS address_description, online_link, meta_desc_' . $lang['type'] . ' AS meta_desc, meta_key_' . $lang['type'] . ' AS meta_key')->where('id != 99')->orderBy('orderBy')->fetchAll();
$promo = $fpdo->from('promo')->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description')->where(array('isActive' => 1))->fetchAll();
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

$page = $config['path']['pages'] .  ($parse_url['path'] == '/' ? '/main.php' : $parse_url['path'] . '.php');

if (file_exists($page))
    include "$page";
else {
    header('HTTP/1.0 404 Not Found');
    readfile('templates/404.html');
    }