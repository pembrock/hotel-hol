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
    $ttid = intval($data['ttid']);
    $hid = intval($data['hid']);
    $start_ts = new \DateTime($data['start_ts'] . ' 00:00:00');
    $title = $data['title'];
    $isActive = $data['isActive'];
    $rates = $data['rates'];

    $set = array('title' => $title, 'tid' => $tid, 'hid' => $hid, 'isActive' => $isActive, 'start_ts' => $start_ts->format('Y-m-d H:i:s'));

    if($ttid > 0)
        $query = $fpdo->update('tarif_tables')->set($set)->where('id', $ttid);
    else {
        $query = $fpdo->insertInto('tarif_tables')->values($set);
    }
    $query->execute();
    $ttid = $ttid > 0 ? $ttid : $pdo->lastInsertId();

    foreach($rates as $key => $value){
        $values = explode('_', $key);
        $rid = $values[0];
        $guests = $values[1];
        $cost = $value;

        $query = $fpdo->deleteFrom('rates2room')->where(array('tid' => $tid, 'hid' => $hid, 'rid' => $rid, 'guests' => $guests, 'ttid' => $ttid));
        $query->execute();

        $insertData = array('hid' => $hid, 'rid' => $rid, 'tid' => intval($tid), 'cost' => intval($cost) == 0 ? NULL : intval($cost), 'guests' => $guests, 'ttid' => $ttid);
        $query = $fpdo->insertInto('rates2room', $insertData);
        $query->execute();
    }

    header('location: rates_room.php?tid=' . $tid . '&hid=' . $hid . '&ttid=' . $ttid);
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
    $tables = $fpdo->from('tarif_tables')->where(array('tid' => $_GET['tid']))->orderBy('start_ts DESC, id DESC')->fetchAll();
    $rate = $fpdo->from('rates')->select(null)->select(array('title'))->where(array('id' => $_GET['tid']))->fetch();
    echo $twig->render('/admin/rates_tables_list.html.twig', array('tables' => $tables, 'tid' => $_GET['tid'], 'rate' => $rate));
}