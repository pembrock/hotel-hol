<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */
if(isset($_GET['id'])){
    $promo = $fpdo->from('promo')->select(null)->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description, text_'  . $lang['type'] . ' AS text, start_ts, stop_ts, image, slide_image, meta_desc_' . $lang['type'] . ' AS meta_desc, meta_key_' . $lang['type'] . ' AS meta_key')->where(array('isActive' => 1, 'id' => intval($_GET['id'])))->fetchAll();
    $twig->addGlobal('metadesc', $promo[0]['meta_desc']);
    $twig->addGlobal('metakey', $promo[0]['meta_key']);
    echo $twig->render('/front/promo-item.html.twig', array('promo' => $promo));
}
else {
    $promo = $fpdo->from('promo')->select('id, title_' . $lang['type'] . ' AS title, description_' . $lang['type'] . ' AS description, text_'  . $lang['type'] . ' AS text, start_ts, stop_ts, image, slide_image')->where(array('isActive' => 1))->fetchAll();
    echo $twig->render('/front/promo.html.twig', array('promo' => $promo));
}