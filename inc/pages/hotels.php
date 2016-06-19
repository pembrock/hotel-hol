<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */
if(isset($_GET['id'])){
        $id = intval($_GET['id']);
        $hotel = $fpdo->from('hotel')->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description, logo, phone, phone2, email, address_' . $lang['type'] . ' AS address, subway_' . $lang['type'] . ' AS subway, maps_link, address_description_' . $lang['type'] . ' AS address_description, online_link, meta_desc_' . $lang['type'] . ' AS meta_desc, meta_key_' . $lang['type'] . ' AS meta_key')->where(array('id' => $id))->fetch();
        $block = $fpdo->from('blocks')->select('system, title_' . $lang['type'] . ' AS title, text_' . $lang['type'] . ' AS text')->where(array('system' => 'roomshas'))->fetch();

    /**
     * Получаем минимальную цену за сутки
     */
    /*Выбираем все активные тарифы суточные и часовые*/
    $activeRatesDay = $fpdo->from('rates')->select(null)->select('id')->where(array('isActive' => 1, 'type' => 1))->fetchAll();
    $activeRatesHour = $fpdo->from('rates')->select(null)->select('id')->where(array('isActive' => 1, 'type' => 2))->fetchAll();
    foreach($activeRatesDay as $ard)
        $rates_day[] = $ard['id'];
    foreach($activeRatesHour as $arh)
        $rates_hour[] = $arh['id'];
    $rates_day = implode(', ', $rates_day);
    $rates_hour = implode(', ', $rates_hour);

    /*$query = "select tt.id from rates r inner join tarif_tables tt ON tt.tid = r.id where r.isDefault = 1 and tt.hid = " . $id . " and tt.start_ts <= NOW() order by tt.start_ts DESC limit 1";*/

    /*Выбираем тарифные таблицы суточные и часовые*/
    $query = "select * from tarif_tables where hid = " . $id . " and tid in (" . $rates_day . ") and isACtive = 1 and start_ts <= NOW()";
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $tt = $res->fetchAll();
    foreach($tt as $t)
        $tt_day[] = $t['id'];
    $tt_day = implode(', ', $tt_day);

    $query = "select * from tarif_tables where hid = " . $id . " and tid in (" . $rates_hour . ") and isACtive = 1 and start_ts <= NOW()";
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $tt = $res->fetchAll();
    if ($tt) {
        foreach ($tt as $t)
            $tt_hour[] = $t['id'];
        $tt_hour = implode(', ', $tt_hour);
    }
    /*$query = "select * from rates2room where hid = " . $id . " and tid = " . $activeRates['id'] . " and ttid = " . $tt . " and guests = 1 and cost IS NOT NULL";*/
    $rooms = $fpdo->from('rooms')->select(null)->select('id')->where(array('isActive' => 1))->fetchAll();
    /*Выбираем минимальную цену*/
    if(isset($tt_day)) {
        foreach ($rooms as $room) {
            $query = "select * from rates2room
                where
                cost = (select MIN(cost) from rates2room where hid = " . $id . " and rid = " . $room['id'] . " and tid IN (" . $rates_day . ") and ttid IN (" . $tt_day . ") and cost is not null)
                limit 1";
            $res = $pdo->query($query, PDO::FETCH_ASSOC);
            $rows = $res->fetchAll();
            if ($rows)
                $hotels_room[] = $rows;
        }
    }
    $path_overall = __DIR__ . '/../../public/upload/images/hotel/' . intval($id) . '/overall/';
    $overall_list = array_diff(scandir($path_overall), array('..', '.'));
    $img['path_overall'] = '../../public/upload/images/hotel/' . intval($id) . '/overall/';
    $img['images_overall'] = $overall_list;
    foreach($hotels_room as $hr){
        foreach ($hr as $val) {
            $path = __DIR__ . '/../../public/upload/images/hr/' . intval($id) . '/' . intval($val['rid']);
            $files_list = array_diff(scandir($path), array('..', '.'));



            $query = "select id, title_" . $lang['type'] ." AS title from rooms where id = " . $val['rid'];

            $res2 = $pdo->query($query, PDO::FETCH_ASSOC);
            $room_info = $res2->fetchAll();
            foreach($room_info as $inf){
                $info[$val['id']]['title'] = $inf['title'];
                $info[$val['id']]['id'] = $inf['id'];

            }
            $query = "select description_" . $lang['type'] . " AS description, online_link from rooms2hotels where hid = " . $id . " and rid = " . $val['rid'];
            $res2 = $pdo->query($query, PDO::FETCH_ASSOC);
            $room_info = $res2->fetchAll();
            foreach($room_info as $inf){
                $info[$val['id']]['description'] = $inf['description'];
                $info[$val['id']]['online_link'] = $inf['online_link'];
            }

            $info[$val['id']]['cost'] = $val['cost'];
            if (isset($tt_hour)) {
                $query2 = "select cost from rates2room where cost = (select MIN(cost) from rates2room where hid = " . $id . " and rid = " . $val['rid'] . " and tid IN (" . $rates_hour . ") and ttid IN (" . $tt_hour . ") and cost is not null) limit 1";
                $res2 = $pdo->query($query2, PDO::FETCH_ASSOC);
                $rows2 = $res2->fetch();
                if ($rows2) {
                    $info[$val['id']]['cost_hour'] = $rows2['cost'];
                }
            }
            $info[$val['id']]['images'] = $files_list;
            $info[$val['id']]['path'] = '../../public/upload/images/hr/' . intval($id) . '/' . intval($val['rid']);
            $info[$val['id']]['group'] = $val['rid'];

        }

    }
    /*Дополнительные услуги*/
    $query = "select at.id, at.title_" . $lang['type'] . " AS title from attraction at
                inner join hotel2attraction h2a ON h2a.aid = at.id
                where at.isActive = 1 and h2a.hid = " . $id;
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $attraction = $res->fetchAll();

    $query = "SELECT id FROM additional_tables WHERE isActive = 1 AND start_ts <= NOW()";
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $add_ttid = $res->fetchColumn();

    $query = "select adc.cost, ads.title_" . $lang['type'] . " AS title, description_" . $lang['type'] . " AS description from additional_costs adc
                inner join additional_service ads ON ads.id = adc.ad_id
                where adc.ttid = " . $add_ttid . " and adc.hid = " . $id . " and ads.isActive = 1";
    $res = $pdo->query($query, PDO::FETCH_ASSOC);
    $additional = $res->fetchAll();
    /*Дополнительные услуги*/

    //comments
    $comments = $fpdo->from('review')->where(array('isActive' => 1, 'hid' => $id))->orderBy('date DESC')->fetchAll();
        echo $twig->render('/front/hotel.html.twig', array('hotel' => $hotel, 'block' => $block, 'info' => $info, 'img' => $img, 'additional' => $additional, 'comments' => $comments, 'attraction' => $attraction));
}
else{
        $block = $fpdo->from('blocks')->where(array('system' => 'hotels'))->fetch();

        $hotels = $fpdo->from('hotel')->select(null)->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description, logo, phone, phone2, email, address_' . $lang['type'] . ' AS address, subway_' . $lang['type'] . ' AS subway, maps_link, address_description_' . $lang['type'] . ' AS address_description, online_link, meta_desc_' . $lang['type'] . ' AS meta_desc, meta_key_' . $lang['type'] . ' AS meta_key')->fetchAll();

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