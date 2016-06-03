<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */
if(isset($_GET['id'])){
    $info = $fpdo->from('information')->where(array('isActive' => 1, 'id' => intval($_GET['id'])))->fetchAll();
    echo $twig->render('/front/info-item.html.twig', array('info' => $info));
}
else {
    $info = $fpdo->from('information')->where(array('isActive' => 1))->fetchAll();
    echo $twig->render('/front/info.html.twig', array('info' => $info));
}