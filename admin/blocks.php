<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 21:37
 */

require 'inc/ini.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $title_ru = $_POST['title_ru'];
    $title_us = $_POST['title_us'];
    $title_cn = $_POST['title_cn'];
    $title_fr = $_POST['title_fr'];
    $title_es = $_POST['title_es'];
    $title_vn = $_POST['title_vn'];
    $title_tr = $_POST['title_tr'];
    $text_ru = $_POST['text_ru'];
    $text_us = $_POST['text_us'];
    $text_cn = $_POST['text_cn'];
    $text_fr = $_POST['text_fr'];
    $text_es = $_POST['text_es'];
    $text_vn = $_POST['text_vn'];
    $text_tr = $_POST['text_tr'];
    $isActive = $_POST['isActive'];
    $system = $_POST['system'];

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'title_fr' => $title_fr, 'title_es' => $title_es, 'title_vn' => $title_vn, 'title_tr' => $title_tr, 'text_ru' => $text_ru, 'text_us' => $text_us, 'text_cn' => $text_cn, 'text_fr' => $text_fr, 'text_es' => $text_es, 'text_vn' => $text_vn, 'text_tr' => $text_tr, 'isActive' => $isActive, 'system' => $system);

    if($id > 0)
        $query = $fpdo->update('blocks')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('blocks')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
//    if($id == 0){
//        $orderBy = $fpdo->from('hotel')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
//        $query = $fpdo->update('hotel')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
//        $query->execute();
//    }
    header('Location: /admin/blocks.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('blocks')->where('id', $id);
    $query->execute();

    header('Location: /admin/blocks.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $blocks = $fpdo->from('blocks')->where(array('id' => $id ))->fetch();

        if ($blocks) {
            echo $twig->render('/admin/blockEdit.html.twig', array('blocks' => $blocks));
        }
        else
            echo $twig->render('/admin/blockEdit.html.twig');
    }
    else
        echo $twig->render('/admin/blockEdit.html.twig');

}
else{
    $blocks = $fpdo->from('blocks')->fetchAll();
    echo $twig->render('/admin/blocks.html.twig', array('blocks' => $blocks));
}
