<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'inc/ini.inc.php';
$data = array();
$rooms = $fpdo->from('rooms')->where('isActive', 1)->orderBy('orderBy')->fetchAll();
$hid = isset($_GET['hid']) ? intval($_GET['hid']) : 0;
$rid = isset($_GET['rid']) ? intval($_GET['rid']) : 0;
$data['hid'] = $hid;
$data['rid'] = $rid;
$chainTitle = $fpdo->from('hotel')
    ->select(null)
    ->select(array('title'))
    ->where('id', $hid)
    ->fetchColumn();
$data['chain'] = $chainTitle;

if(isset($_POST['type']))
{
    if($_POST['type'] == 'add') {
        $hid = intval($_POST['id']);
        $rid = intval($_POST['rid']);
        $isActive = intval($_POST['isActive']);
        $cost_hour = intval($_POST['cost_hour']);
        $cost_day = intval($_POST['cost_day']);
        $description = $_POST['description'];
        $query = $fpdo->from('hotel2room')->where(array('hid' => $hid, 'rid' => $rid))->fetchAll();

        if (!empty($query))
        {
            $data['hid'] = $hid;
            $data['error'] = 'Ошибка. Для данной гостиницы уже есть такой номер';
            echo $twig->render('/admin/hotel2room.html.twig', array('rooms' => $rooms, 'data' => $data));
            die();
        }
        else
        {
            $values = array('hid' => $hid, 'rid' => $rid, 'description' => $description, 'cost_hour' => $cost_hour, 'cost_day' => $cost_day, 'isActive' => $isActive);
            $query = $fpdo->insertInto('hotel2room')->values($values);
            $query->execute();

            header('Location: /admin/hotels.php?edit=' . $hid);
        }
    }
    elseif ($_POST['type'] == 'edit'){

        echo $twig->render('/admin/hotel2room.html.twig', array('rooms' => $rooms, 'data' => $data));
    }

}


if (isset($_GET['act']))
{
    $act = $_GET['act'];

    switch($act)
    {
        case 'add':
            $data['type'] = $act;
            break;
        case 'edit':

            $h2r = $fpdo->from('hotel2room')->where(array('hid' => $hid, 'rid' => $rid))->fetch();
            $data['h2r'] = $h2r;
            break;
        case 'del':
            $query = $fpdo->deleteFrom('hotel2room')->where(array('hid' => $hid, 'rid' => $rid));
            $query->execute();
            header('Location: /admin/hotels.php?edit=' . $hid);
    }
    echo $twig->render('/admin/hotel2room.html.twig', array('rooms' => $rooms, 'data' => $data));
}

