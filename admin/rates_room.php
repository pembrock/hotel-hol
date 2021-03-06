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
    $title_ru = $_POST['title_ru'];
    $title_us = $_POST['title_us'];
    $title_cn = $_POST['title_cn'];
    $title_fr = $_POST['title_fr'];
    $title_es = $_POST['title_es'];
    $title_vn = $_POST['title_vn'];
    $title_tr = $_POST['title_tr'];
    $title_de = $_POST['title_de'];
    $description_ru = $_POST['description_ru'];
    $description_us = $_POST['description_us'];
    $description_cn = $_POST['description_cn'];
    $description_fr = $_POST['description_fr'];
    $description_es = $_POST['description_es'];
    $description_vn = $_POST['description_vn'];
    $description_tr = $_POST['description_tr'];
    $description_de = $_POST['description_de'];
    $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : null;
    $isDefault = isset($_POST['isDefault']) ? $_POST['isDefault'] : null;
    $type = intval($_POST['type']);


    if (empty($title_ru))
        $error[] = "Введите название";
    if (empty($description_ru))
        $error[] = "Введите описание";

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'title_fr' => $title_fr, 'title_es' => $title_es, 'title_vn' => $title_vn, 'title_tr' => $title_tr, 'title_de' => $title_de, 'description_ru' => $description_ru,  'description_us' => $description_us, 'description_cn' => $description_cn, 'description_fr' => $description_fr, 'description_es' => $description_es, 'description_vn' => $description_vn, 'description_tr' => $description_tr, 'description_de' => $description_de, 'isDefault' => $isDefault, 'isActive' => $isActive, 'type' => $type);

    if (!$error) {
        if ($id > 0) {
            $query = $fpdo->update('rates')->set($set)->where('id', $id);
        } else {
            $query = $fpdo->insertInto('rates')->values($set);
        }
        $query->execute();
        $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
        if ($id == 0) {
            $orderBy = $fpdo->from('rates')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
            $query = $fpdo->update('rates')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
            $query->execute();
        }
        header('Location: /admin/rates_room.php?edit=' . $insert_id);
    }
    else {
        echo $twig->render('/admin/rates_roomEdit.html.twig', array('error' => $error, 'rates' => $set));
        die();
    }
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

if (isset($_GET['deltable'], $_GET['hid'], $_GET['tid'], $_GET['ttid']))
{
    $ttid = intval($_GET['ttid']);
    $tid = intval($_GET['tid']);
    $hid = intval($_GET['hid']);

    $query = $fpdo->deleteFrom('tarif_tables')->where('id', $ttid);
    $query->execute();
    $query = $fpdo->deleteFrom('rates2room')->where('ttid', $ttid);
    $query->execute();

    header('Location: /admin/rates_room.php?list&tid=' . $tid . '&hid=' . $hid);
}

if (isset($_GET['copy'], $_GET['tid'], $_GET['hid'], $_GET['ttid']))
{
    $ttid = intval($_GET['ttid']);
    $tid = intval($_GET['tid']);
    $hid = intval($_GET['hid']);
    $table = $fpdo->from('tarif_tables')->where('id', $ttid)->fetch();
    $start_ts = new \DateTime($table['start_ts']);
    $set = array('hid' => $table['hid'], 'tid' => $table['tid'], 'title' => $table['title'] . '-КОПИЯ', 'isActive' => $table['isActive'], 'start_ts' => $start_ts->format('Y-m-d H:i:s'));
    $query = $fpdo->insertInto('tarif_tables')->values($set);
    $query->execute();
    $new_ttid = $pdo->lastInsertId();
    $rates2room = $fpdo->from('rates2room')->where(array('hid' => $hid, 'tid' => $tid, 'ttid' => $ttid))->fetchAll();
    foreach($rates2room as $key => $value)
    {
        $setRates = array('hid' => $value['hid'], 'rid' => $value['rid'], 'tid' => $value['tid'], 'ttid' => $new_ttid, 'cost' => $value['cost'], 'guests' => $value['guests']);

        $query = $fpdo->insertInto('rates2room')->values($setRates);
        $query->execute();
    }

    header('Location: /admin/rates_room.php?tid=' . $tid . '&hid=' . $hid . '&ttid=' . $new_ttid);
}

if (isset($_GET['tid'], $_GET['hid'], $_GET['ttid']))
{
    $tid = intval($_GET['tid']);
    $hid = intval($_GET['hid']);
    $ttid = intval($_GET['ttid']);
    $rooms = $fpdo->from('rooms')->select(null)->select(array('id', 'title_ru'))->orderBy('orderBy')->fetchAll();
    $rate = $fpdo->from('rates')->where(array('id' => $tid))->fetch();
    $hotel_name = $fpdo->from('hotel')->select(null)->select(array('title_ru'))->where(array('id' => $hid))->fetchColumn();
    if ($ttid > 0){
        $ttable = $fpdo->from('tarif_tables')->where(array('id' => $ttid))->fetch();
        $costs_array = $fpdo->from('rates2room')->where(array('hid' => $hid, 'tid' => $tid, 'ttid' => $ttid))->fetchAll();
        foreach ($costs_array as $val ) {
            $costs[$val['rid']][$val['guests']] = $val['cost'];
        }

        echo $twig->render('/admin/tariff_tableEdit.html.twig', array('rate' => $rate, 'rooms' => $rooms, 'tid' => $tid, 'hid' => $hid, 'ttid' => $ttid, 'ttable' => $ttable, 'costs' =>$costs, 'hotel_name' => $hotel_name));
    }
    else {
        echo $twig->render('/admin/tariff_tableEdit.html.twig', array('rate' => $rate, 'rooms' => $rooms, 'tid' => $tid, 'hid' => $hid, 'hotel_name' => $hotel_name));
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
    $rates = $fpdo->from('rates')->select('id, title_ru AS title')->fetchAll();
    echo $twig->render('/admin/rates_room.html.twig', array('rates' => $rates));
}
