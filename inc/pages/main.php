<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 15:32
 */

$blocks_array = $fpdo->from('blocks')->where(array('isActive' => 1))->fetchAll();
$blocks = array();
foreach($blocks_array as $block){
    $blocks[$block['system']]['title'] = $block['title'];
    $blocks[$block['system']]['text'] = $block['text'];
}

echo $twig->render('/front/main.html.twig', array('rooms' => $rooms, 'blocks' => $blocks));