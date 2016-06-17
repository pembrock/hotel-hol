<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */
if(isset($_GET['id'])){
    $attraction = $fpdo->from('attraction')->select('id, title_' . $lang['type'] . ' AS title, text_' . $lang['type'] . ' AS text')->where(array('isActive' => 1, 'id' => intval($_GET['id'])))->fetchAll();
    echo $twig->render('/front/attraction-item.html.twig', array('attraction' => $attraction));
}
else {
    $attraction = $fpdo->from('attraction')->select('id, title_' . $lang['type'] . ' AS title')->where(array('isActive' => 1))->fetchAll();
    echo $twig->render('/front/attraction.html.twig', array('attraction' => $attraction));
}