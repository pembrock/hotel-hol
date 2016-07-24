<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */
if(isset($_GET['id'])){
        $id = intval($_GET['id']);
        $hotel = $fpdo->from('hotel')->where(array('id' => $id))->fetch();
        $block = $fpdo->from('blocks')->where(array('system' => 'roomshas'))->fetch();



    $activeRates = $fpdo->from('rates')->select(null)->select('id')->where(array('isActive' => 1))->fetch();
    $query = "select tt.id from rates r inner join tarif_tables tt ON tt.tid = r.id where r.isDefault = 1 and tt.start_ts <= NOW() order by tt.start_ts DESC limit 1";
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $tt = $res->fetchColumn();
    $query = "select * from rates2room where hid = " . $id . " and tid = " . $activeRates['id'] . " and ttid = " . $tt . " and guests = 1 and (cost_hour IS NOT NULL and cost_day IS NOT NULL)";
        $res = $pdo->query($query, PDO::FETCH_ASSOC);
        $rows = $res->fetchAll();
        $hotels_room[] = $rows;

    foreach($hotels_room as $hr){
        foreach ($hr as $val) {
            $path = __DIR__ . '/../../public/upload/images/hr/' . intval($id) . '/' . intval($val['rid']);
            $files_list = array_diff(scandir($path), array('..', '.'));

            $query = "select title from rooms where id = " . $val['rid'];
            $res2 = $pdo->query($query, PDO::FETCH_ASSOC);
            $room_info = $res2->fetchAll();
            foreach($room_info as $inf){
                $info[$val['id']]['title'] = $inf['title'];
            }
            $query = "select description, online_link from rooms2hotels where hid = " . $id . " and rid = " . $val['rid'];
            $res2 = $pdo->query($query, PDO::FETCH_ASSOC);
            $room_info = $res2->fetchAll();
            foreach($room_info as $inf){
                $info[$val['id']]['description'] = $inf['description'];
                $info[$val['id']]['online_link'] = $inf['online_link'];
            }
            $info[$val['id']]['group'] = $val['rid'];
            $info[$val['id']]['cost_hour'] = $val['cost_hour'];
            $info[$val['id']]['cost_day'] = $val['cost_day'];
            $info[$val['id']]['images'] = $files_list;
            $info[$val['id']]['path'] = '../../public/upload/images/hr/' . intval($id) . '/' . intval($val['rid']);
        }

    }
        echo $twig->render('/front/hotel.html.twig', array('hotel' => $hotel, 'block' => $block, 'hotel_room' => $hotel_room, 'info' => $info));
}
else{
        $block = $fpdo->from('blocks')->where(array('system' => 'hotels'))->fetch();

        $hotels = $fpdo->from('hotel')->fetchAll();

        foreach($hotels as $hotel => $h){
                $min_hour = $fpdo->from('rates2room')
                                 ->innerJoin('rates ON rates.id = rates2room.tid')
                                 ->select(null)
                                 ->select('min(rates2room.cost_hour) AS mch')
                                 ->where(array('rates.isActive' => 1, 'rates2room.hid' => $h['id']))
                                 ->fetch();
                $hotels[$hotel]['min_hour'] = $min_hour['mch'];

                $min_day = $fpdo->from('rates2room')
                                ->innerJoin('rates ON rates.id = rates2room.tid')
                                ->select(null)
                                ->select('min(rates2room.cost_day) AS mcd')
                                ->where(array('rates.isActive' => 1, 'rates2room.hid' => $h['id']))
                                ->fetch();
                $hotels[$hotel]['min_day'] = $min_day['mcd'];
        }

        echo $twig->render('/front/hotels.html.twig', array('block' => $block, 'hotels' => $hotels));
}