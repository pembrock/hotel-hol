<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 21:37
 */

require 'inc/ini.inc.php';

if (isset($_POST['getData'])){
    $tid = $_POST['tid'];
    $tt = $_POST['tt'];
    $guests = $_POST['guests'];
    $rates = $fpdo->from('rates2room')->where(array('tid' => $tid, 'ttid' => $tt, 'guests' => $guests))->fetchAll();
    $rates_data = array();
    foreach($rates as $value){
        $rates_data['rates_' . $value['hid'] . '_' . $value['rid'] . '_day'] = $value['cost_day'];
        $rates_data['rates_' . $value['hid'] . '_' . $value['rid'] . '_hour'] = $value['cost_hour'];
    }

    echo json_encode($rates_data);
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = $_POST;
    $tid = intval($data['tid']);
    $tt = intval($data['tt']);
    $guests = intval($data['guests']);
    $start_ts = new \DateTime($data['start_ts'] . ' 00:00:00');
    //$start_ts = DateTime::createFromFormat('d/m/Y', $da)
//    $start_ts = date('Y-m-d', strtotime(str_replace('/', '-', $date['start_ts'])));
    $title = $data['title'];
    $isActive = $data['isActive'] == "true" ? 1 : 0;
    $data = $data['json_data'];
    $rates = array();

    $set = array('title' => $title, 'tid' => $tid, 'isActive' => $isActive, 'start_ts' => $start_ts->format('Y-m-d H:i:s'));

    if($tt > 0)
        $query = $fpdo->update('tarif_tables')->set($set)->where('id', $tt);
    else {
        $query = $fpdo->insertInto('tarif_tables')->values($set);
    }
    $query->execute();
    $tt = $tt > 0 ? $tt : $pdo->lastInsertId();

    foreach($data as $value){
        $values = explode('_', $value['name']);
        $hid = $values[1];
        $rid = $values[2];
        $type = $values[3];
        $cost = $value['value'];
        $rates[$hid][$rid][$type] = $cost;
    }
    $query = $fpdo->deleteFrom('rates2room')->where(array('tid' => $tid, 'guests' => $guests, 'ttid' => $tt));
    $query->execute();

    foreach($rates as $key => $value){
        foreach($value as $k => $val){
            $insertData = array('hid' => intval($key), 'rid' => intval($k), 'tid' => intval($tid), 'cost_hour' => intval($val['hour']) == 0 ? NULL : intval($val['hour']), 'cost_day' => intval($val['day']) == 0 ? NULL : intval($val['day']), 'guests' => $guests, 'ttid' => $tt);
            $query = $fpdo->insertInto('rates2room', $insertData);
            $query->execute();
        }
    }

    echo json_encode(array('tt' => $tt));
    die();
}

$rooms = $fpdo->from('rooms')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
$hotels = $fpdo->from('hotel')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
$rates = $fpdo->from('rates')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
if (isset($_GET['tid']) && isset($_GET['tt']))
{
    if (intval($_GET['tt']) > 0)
        $table = $fpdo->from('tarif_tables')->where(array('id' => $_GET['tt']))->fetch();
    else
        $table = null;
    $rate = $fpdo->from('rates')->select(null)->select(array('title'))->where(array('id' => $_GET['tid']))->fetch();
    echo $twig->render('/admin/rates_tables.html.twig', array('rooms' => $rooms, 'hotels' => $hotels, 'rates' => $rates, 'tid' => $_GET['tid'], 'tt' => $_GET['tt'], 'table' => $table, 'rate' => $rate));
}
else {
    $tables = $fpdo->from('tarif_tables')->where(array('tid' => $_GET['tid']))->fetchAll();
    $rate = $fpdo->from('rates')->select(null)->select(array('title'))->where(array('id' => $_GET['tid']))->fetch();
    echo $twig->render('/admin/rates_tables_list.html.twig', array('tables' => $tables, 'tid' => $_GET['tid'], 'rate' => $rate));
}