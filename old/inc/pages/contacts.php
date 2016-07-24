<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */

$hotels = $fpdo->from('hotel')->fetchAll();

echo $twig->render('/front/contacts.html.twig', array('hotels' => $hotels));