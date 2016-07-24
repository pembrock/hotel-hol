<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */
if(isset($_GET['id'])){
    $promo = $fpdo->from('promo')->where(array('isActive' => 1, 'id' => intval($_GET['id'])))->fetchAll();
    echo $twig->render('/front/promo-item.html.twig', array('promo' => $promo));
}
else {
    $promo = $fpdo->from('promo')->where(array('isActive' => 1))->fetchAll();
    echo $twig->render('/front/promo.html.twig', array('promo' => $promo));
}