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
    $data = $_POST;
    $ttid = intval($data['ttid']);
    $start_ts = new \DateTime($data['start_ts'] . ' 00:00:00');
    $title = $data['title'];
    $isActive = $data['isActive'];
    $costs = $data['costs'];

    $set = array('title' => $title, 'isActive' => $isActive, 'start_ts' => $start_ts->format('Y-m-d H:i:s'));

    if($ttid > 0)
        $query = $fpdo->update('additional_tables')->set($set)->where('id', $ttid);
    else {
        $query = $fpdo->insertInto('additional_tables')->values($set);
    }
    $query->execute();
    $ttid = $ttid > 0 ? $ttid : $pdo->lastInsertId();

    foreach($costs as $key => $value){
        $values = explode('_', $key);
        $hid = $values[0];
        $ad_id = $values[1];
        $cost = $value;

        $query = $fpdo->deleteFrom('additional_costs')->where(array('ad_id' => $ad_id, 'ttid' => $ttid, 'hid' => $hid));
        $query->execute();

        $insertData = array('ad_id' => $ad_id, 'ttid' => $ttid, 'hid' => $hid, 'cost' => intval($cost) == 0 ? NULL : intval($cost));
        $query = $fpdo->insertInto('additional_costs', $insertData);
        $query->execute();
    }

    header('location: rates_service.php?edit=' . $ttid);
    die();
}

if (isset($_GET['del']))
{
    $id = intval($_GET['del']);
    $query = $fpdo->deleteFrom('additional_tables')->where('id', $id);
    $query->execute();
    $query = $fpdo->deleteFrom('additional_costs')->where('ttid', $id);
    $query->execute();

    header('Location: /admin/rates_service.php');
}

$hotels = $fpdo->from('hotel')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
$service = $fpdo->from('additional_service')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
if (isset($_GET['edit']))
{
    $id = intval($_GET['edit']);
    if ($id > 0)
    {
        $table = $fpdo->from('additional_tables')->where('id', $id)->fetch();
        $costs_array = $fpdo->from('additional_costs')->where('ttid', $id)->fetchAll();
        $costs = array();
        foreach($costs_array as $val)
        {
            $costs[$val['hid']][$val['ad_id']] = $val['cost'];
        }
        echo $twig->render('/admin/service_tablesEdit.html.twig', array('hotels' => $hotels, 'service' => $service, 'table' => $table, 'costs' => $costs));
    }
    else
        echo $twig->render('/admin/service_tablesEdit.html.twig', array('hotels' => $hotels, 'service' => $service));
}
else {

    $tables = $fpdo->from('additional_tables')->orderBy('start_ts')->fetchAll();
    echo $twig->render('/admin/service_tables.html.twig', array('tables' => $tables));
}