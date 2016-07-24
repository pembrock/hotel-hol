<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'inc/ini.inc.php';

if (isset($_POST)) {
    $hid = intval($_POST['hid']);
    $rid = intval($_POST['rid']);

    $values = array('hid' => $hid, 'rid' => $rid);
    $query = $fpdo->insertInto('rates2hotel')->values($values);
    $query->execute();

    header('Location: /admin/hotels.php?edit=' . $hid);
}

if (isset($_GET['act'])) {
    $data = array();
    $data['hid'] = intval($_GET['hid']);

    $chainTitle = $fpdo->from('hotel')
            ->select(null)
            ->select(array('title'))
            ->where('id', $data['hid'])
            ->fetchColumn();
    $data['chain'] = $chainTitle;

    $rates = $fpdo->from('rates')->fetchAll();
    echo $twig->render('/admin/rates2hotel.html.twig', array('rates' => $rates, 'data' => $data));
}