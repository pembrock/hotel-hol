<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */
if(isset($_GET['id'])){
    $info = $fpdo->from('information')->select('id, title_' . $lang['type'] . ' AS title, text_' . $lang['type'] . ' AS text, meta_desc_' . $lang['type'] . ' AS meta_desc, meta_key_' . $lang['type'] . ' AS meta_key')->where(array('isActive' => 1, 'id' => intval($_GET['id'])))->fetchAll();
    $twig->addGlobal('metadesc', $info[0]['meta_desc']);
    $twig->addGlobal('metakey', $info[0]['meta_key']);
    echo $twig->render('/front/info-item.html.twig', array('info' => $info));
}
else {
    $info = $fpdo->from('information')->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description, date, logo')->where(array('isActive' => 1))->fetchAll();
    echo $twig->render('/front/info.html.twig', array('info' => $info));
}