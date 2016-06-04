<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */

$blocks_array = $fpdo->from('blocks')->select('system, title_' . $lang['type'] . ' AS title, text_' . $lang['type'] . ' AS text')->where(array('isActive' => 1))->fetchAll();
$blocks = array();
foreach($blocks_array as $block){
    $blocks[$block['system']]['title'] = $block['title'];
    $blocks[$block['system']]['text'] = $block['text'];
}

echo $twig->render('/front/rules.html.twig', array('blocks' => $blocks));