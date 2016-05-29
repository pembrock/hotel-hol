<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 21:37
 */

require 'inc/ini.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : null;
    $isDefault = isset($_POST['isDefault']) ? $_POST['isDefault'] : null;
    $type = intval($_POST['type']);

    $set = array('title' => $title, 'description' => $description, 'isDefault' => $isDefault, 'isActive' => $isActive, 'type' => $type);

    if($id > 0)
        $query = $fpdo->update('rates')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('rates')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
    if($id == 0){
        $orderBy = $fpdo->from('rates')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
        $query = $fpdo->update('rates')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
        $query->execute();
    }
    header('Location: /admin/rates_room.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('rates')->where('id', $id);
    $query->execute();
    $query = $fpdo->deleteFrom('tarif_tables')->where('tid', $id);
    $query->execute();
    $query = $fpdo->deleteFrom('rates2room')->where('tid', $id);
    $query->execute();

    header('Location: /admin/rates_room.php');
}
if (isset($_GET['tid'], $_GET['hid'], $_GET['ttid']))
{
    $tid = intval($_GET['tid']);
    $hid = intval($_GET['hid']);
    $ttid = intval($_GET['ttid']);
    $rooms = $fpdo->from('rooms')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
    $rate = $fpdo->from('rates')->where(array('id' => $tid))->fetch();
    if ($ttid > 0){
        $ttable = $fpdo->from('tarif_tables')->where(array('id' => $ttid))->fetch();
        $costs_array = $fpdo->from('rates2room')->where(array('hid' => $hid, 'tid' => $tid, 'ttid' => $ttid))->fetchAll();
        foreach ($costs_array as $val ) {
            $costs[$val['rid']][$val['guests']] = $val['cost'];
        }

        echo $twig->render('/admin/tariff_tableEdit.html.twig', array('rate' => $rate, 'rooms' => $rooms, 'tid' => $tid, 'hid' => $hid, 'ttid' => $ttid, 'ttable' => $ttable, 'costs' =>$costs));
    }
    else {
        echo $twig->render('/admin/tariff_tableEdit.html.twig', array('rate' => $rate, 'rooms' => $rooms, 'tid' => $tid, 'hid' => $hid));
    }
    die();
}

if (isset($_GET['list'], $_GET['tid'], $_GET['hid']))
{
    $tid = intval($_GET['tid']);
    $hid = intval($_GET['hid']);
    $rate = $fpdo->from('rates')->where(array('id' => $tid))->fetch();
    $hotel = $fpdo->from('hotel')->where(array('id' => $hid))->fetch();
    $tables = $fpdo->from('tarif_tables')->where(array('tid' => $tid, 'hid' => $hid))->orderBy('start_ts')->fetchAll();
    echo $twig->render('/admin/tariff_list.html.twig', array('tables' => $tables, 'rate' => $rate, 'hotel' => $hotel, 'tid' => $tid, 'hid' => $hid));

    die();
}

if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $rates = $fpdo->from('rates')->where(array('id' => $id ))->fetch();
        $hotels = $fpdo->from('hotel')->orderBy('orderBy')->fetchAll();
        if ($rates) {
            echo $twig->render('/admin/rates_roomEdit.html.twig', array('rates' => $rates, 'hotels' => $hotels));
        }
        else
            echo $twig->render('/admin/rates_roomEdit.html.twig');
    }
    else
        echo $twig->render('/admin/rates_roomEdit.html.twig');

}
else{
    $rates = $fpdo->from('rates')->fetchAll();
    echo $twig->render('/admin/rates_room.html.twig', array('rates' => $rates));
}
