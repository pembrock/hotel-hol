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
    $query = "select tt.id from rates r inner join tarif_tables tt ON tt.tid = r.id where r.isDefault = 1 and tt.hid = " . $id . " and tt.start_ts <= NOW() order by tt.start_ts DESC limit 1";
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $tt = $res->fetchColumn();
    $query = "select * from rates2room where hid = " . $id . " and tid = " . $activeRates['id'] . " and ttid = " . $tt . " and guests = 1 and cost IS NOT NULL";
        $res = $pdo->query($query, PDO::FETCH_ASSOC);
        $rows = $res->fetchAll();
        $hotels_room[] = $rows;
    $path_overall = __DIR__ . '/../../public/upload/images/hotel/' . intval($id) . '/overall/';
    $overall_list = array_diff(scandir($path_overall), array('..', '.'));
    $img['path_overall'] = '../../public/upload/images/hotel/' . intval($id) . '/overall/';
    $img['images_overall'] = $overall_list;
    foreach($hotels_room as $hr){
        foreach ($hr as $val) {
            $path = __DIR__ . '/../../public/upload/images/hr/' . intval($id) . '/' . intval($val['rid']);
            $files_list = array_diff(scandir($path), array('..', '.'));



            $query = "select id, title from rooms where id = " . $val['rid'];

            $res2 = $pdo->query($query, PDO::FETCH_ASSOC);
            $room_info = $res2->fetchAll();
            foreach($room_info as $inf){
                $info[$val['id']]['title'] = $inf['title'];
                $info[$val['id']]['id'] = $inf['id'];

            }
            $query = "select description, online_link from rooms2hotels where hid = " . $id . " and rid = " . $val['rid'];
            $res2 = $pdo->query($query, PDO::FETCH_ASSOC);
            $room_info = $res2->fetchAll();
            foreach($room_info as $inf){
                $info[$val['id']]['description'] = $inf['description'];
                $info[$val['id']]['online_link'] = $inf['online_link'];
            }

            $info[$val['id']]['cost'] = $val['cost'];
            $info[$val['id']]['images'] = $files_list;
            $info[$val['id']]['path'] = '../../public/upload/images/hr/' . intval($id) . '/' . intval($val['rid']);
            $info[$val['id']]['group'] = $val['rid'];

        }

    }

    $query = "SELECT id FROM additional_tables WHERE isActive = 1 AND start_ts <= NOW()";
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $add_ttid = $res->fetchColumn();

    $query = "select adc.cost, ads.title from additional_costs adc
                inner join additional_service ads ON ads.id = adc.ad_id
                where adc.ttid = " . $add_ttid . " and adc.hid = " . $id;
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $additional = $res->fetchAll();

    //comments
    $comments = $fpdo->from('review')->where(array('isActive' => 1, 'hid' => $id))->orderBy('date DESC')->fetchAll();
        echo $twig->render('/front/hotel.html.twig', array('hotel' => $hotel, 'block' => $block, 'info' => $info, 'img' => $img, 'additional' => $additional, 'comments' => $comments));
}
else{
        $block = $fpdo->from('blocks')->where(array('system' => 'hotels'))->fetch();

        $hotels = $fpdo->from('hotel')->fetchAll();

        foreach($hotels as $hotel => $h){
                $cost = $fpdo->from('rates2room')
                                 ->innerJoin('rates ON rates.id = rates2room.tid')
                                 ->select(null)
                                 ->select('cost')
                                 ->where(array('rates.isActive' => 1, 'rates2room.hid' => $h['id']))
                                 ->fetch();
                $hotels[$hotel]['cost'] = $cost['cost'];
        }

        echo $twig->render('/front/hotels.html.twig', array('block' => $block, 'hotels' => $hotels));
}