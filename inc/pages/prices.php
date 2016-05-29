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
        echo "123";
        die();
        $rate = intval($_POST['tid']);
        $guests = intval($_POST['guests']);
        $hotels_rates = array();
        foreach ($hotels as $hotel)
        {
                $query = "SELECT id FROM tarif_tables WHERE tid = " . $rates . " AND hid = " . $hotel['id'] . " AND isACtive = 1 AND start_ts <= NOW()";
                $res = $pdo->query($query, PDO::FETCH_ASSOC);
                $ttid = $res->fetchColumn();

                foreach($rooms as $room)
                {
                        $query = "SELECT cost FROM rates2room WHERE hid = " . $hotel['id'] . " AND rid = " . $room['id'] . " AND tid = " . $rate . " AND ttid = " . $ttid . " AND guests = " . $guests;
                        $res = $pdo->query($query, PDO::FETCH_ASSOC);
                        $cost = $res->fetchColumn();
                        $hotels_rates[$hotel['id'] . '_' . $room['id']] = $cost;
                }
        }

        echo json_encode($hotels_rates);
        die();
}

$default_rate = $fpdo->from('rates')->select(null)->select(array('id'))->where(array('isDefault' => 1, 'isActive' => 1))->fetch();
$hotels_rates = array();
foreach ($hotels as $hotel)
{
        $query = "SELECT id FROM tarif_tables WHERE tid = " . $default_rate['id'] . " AND hid = " . $hotel['id'] . " AND isACtive = 1 AND start_ts <= NOW()";
        $res = $pdo->query($query, PDO::FETCH_ASSOC);
        $ttid = $res->fetchColumn();

        foreach($rooms as $room)
        {
                $query = "SELECT cost FROM rates2room WHERE hid = " . $hotel['id'] . " AND rid = " . $room['id'] . " AND tid = " . $default_rate['id'] . " AND ttid = " . $ttid . " AND guests = 1";
                $res = $pdo->query($query, PDO::FETCH_ASSOC);
                $cost = $res->fetchColumn();
                $hotels_rates[$hotel['id']][$room['id']] = $cost;
        }
}
echo $twig->render('/front/prices.html.twig', array('block' => $block, 'rooms' => $rooms, 'hotels' => $hotels, 'rates' => $rates, 'hotels_rates' => $hotels_rates));