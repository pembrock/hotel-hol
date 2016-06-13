<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */

$hotels = $fpdo->from('hotel')->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description, logo, phone, phone2, email, address_' . $lang['type'] . ' AS address, subway_' . $lang['type'] . ' AS subway, maps_link, address_description_' . $lang['type'] . ' AS address_description, online_link, meta_desc, meta_key')->orderBy('orderBy')->fetchAll();

echo $twig->render('/front/contacts.html.twig', array('hotels' => $hotels));