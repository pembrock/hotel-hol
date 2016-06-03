<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */

$block = $fpdo->from('blocks')->where(array('system' => 'prices'))->fetch();
$rooms = $fpdo->from('rooms')->select(null)->select(array('id', 'title'))->orderBy('orderBy')->fetchAll();
$rates = $fpdo->from('rates')->where(array('isActive' => 1))->orderBy('isDefault DESC')->fetchAll();
$hotels = $fpdo->from('hotel')->fetchAll();

if (isset($_POST['getRates']))
{
        $rate = intval($_POST['tid']);
        $guests = intval($_POST['guests']);
        $r_desc = $fpdo->from('rates')->select(null)->select(array('description'))->where(array('id' => $rate))->fetch();
        $hotels_rates = array();
        $hotels_rates['description'] = $r_desc['description'];
        foreach ($hotels as $hotel)
        {
                $query = "SELECT id FROM tarif_tables WHERE tid = " . $rate . " AND hid = " . $hotel['id'] . " AND isACtive = 1 AND start_ts <= NOW()";
                $res = $pdo->query($query, PDO::FETCH_ASSOC);
                $ttid = $res->fetchColumn();

                foreach($rooms as $room)
                {
                        if(!$ttid)
                                $hotels_rates[$hotel['id'] . '_' . $room['id']] = null;
                        else {
                                $query = "SELECT cost FROM rates2room WHERE hid = " . $hotel['id'] . " AND rid = " . $room['id'] . " AND tid = " . $rate . " AND ttid = " . $ttid . " AND guests = " . $guests;
                                $res = $pdo->query($query, PDO::FETCH_ASSOC);
                                $cost = $res->fetchColumn();
                                if ($cost)
                                        $hotels_rates[$hotel['id'] . '_' . $room['id']] = $cost;
                                else
                                        $hotels_rates[$hotel['id'] . '_' . $room['id']] = null;
                        }
                }
        }

        echo json_encode($hotels_rates);
        die();
}

$default_rate = $fpdo->from('rates')->select(null)->select(array('id'))->where(array('isDefault' => 1, 'isActive' => 1))->fetch();
$hotels_rates = array();

$query = "SELECT id FROM additional_tables WHERE isActive = 1 AND start_ts <= NOW()";
$res = $pdo->query($query, PDO::FETCH_ASSOC);
$add_ttid = $res->fetchColumn();

$add_service = $fpdo->from('additional_service')->where(array('isActive' => 1))->orderBy('orderBy')->fetchAll();
$services_rates = array();
foreach($add_service as $add) {
        $query = "select * from additional_costs where ad_id = " . $add['id'] . " and ttid = " . $add_ttid;
        $res = $pdo->query($query, PDO::FETCH_ASSOC);
        $additional = $res->fetchAll();
        foreach($additional as $a)
        {
                $services_rates[$a['hid']][$a['ad_id']] = $a['cost'];
        }
}


//$table = $fpdo->from('additional_tables')->where(array('isActive' => 1, ''))->fetch();
//$costs_array = $fpdo->from('additional_costs')->where('ttid', $id)->fetchAll();
//$costs = array();
//foreach($costs_array as $val)
//{
//        $costs[$val['hid']][$val['ad_id']] = $val['cost'];
//}

foreach ($hotels as $hotel)
{
        $query = "SELECT id FROM tarif_tables WHERE tid = " . $default_rate['id'] . " AND hid = " . $hotel['id'] . " AND isACtive = 1 AND start_ts <= NOW()";
        $res = $pdo->query($query, PDO::FETCH_ASSOC);
        $ttid = $res->fetchColumn();

        foreach($rooms as $room)
        {
                $query = "SELECT cost FROM rates2room WHERE hid = " . $hotel['id'] . " AND rid = " . $room['id'] . " AND tid = " . $default_rate['id'] . " AND ttid = " . $ttid . " AND guests = 1";
                if($res = $pdo->query($query, PDO::FETCH_ASSOC)) {
                        $cost = $res->fetchColumn();
                        $hotels_rates[$hotel['id']][$room['id']] = $cost;
                }
        }
}
echo $twig->render('/front/prices.html.twig', array('block' => $block, 'rooms' => $rooms, 'hotels' => $hotels, 'rates' => $rates, 'hotels_rates' => $hotels_rates, 'services' => $add_service, 'services_rates' => $services_rates));