<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */

$block = $fpdo->from('blocks')->where(array('system' => 'prices'))->fetch();
$rooms = $fpdo->from('rooms')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
$rates = $fpdo->from('rates')->where(array('isActive' => 1))->fetchAll();
$hotels = $fpdo->from('hotel')->fetchAll();
/*
 *      select tt.id, r.title, tt.title, tt.start_ts from rates r
        inner join tarif_tables tt ON tt.tid = r.id
        where r.isDefault = 1 and tt.start_ts <= NOW()
        order by tt.start_ts DESC
        limit 1
 */
$query = "select tt.id from rates r inner join tarif_tables tt ON tt.tid = r.id where r.isDefault = 1 and tt.start_ts <= NOW() order by tt.start_ts DESC limit 1";
$res = $pdo->query($query, PDO::FETCH_ASSOC);
$tt = $res->fetchColumn();

foreach($hotels as $key => $value){
        $rates_ar = $fpdo->from('rates2room')->innerJoin('rates ON rates.id = rates2room.tid')->where(array('rates.isActive' => 1, 'rates2room.hid' => $hotels[$key]['id'], 'rates2room.guests' => 1, 'rates2room.ttid' => $tt))->fetchAll();

        $hotels[$key]['rates'] = $rates_ar;
}

echo $twig->render('/front/prices.html.twig', array('block' => $block, 'rooms' => $rooms, 'hotels' => $hotels, 'rates' => $rates));