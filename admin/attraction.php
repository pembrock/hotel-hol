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
    $isActive = $_POST['isActive'];
    $text_ru = $_POST['text_ru'];
    $text_us = $_POST['text_us'];
    $text_cn = $_POST['text_cn'];

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'text_ru' => $text_ru,  'text_us' => $text_us,  'text_cn' => $text_cn, 'isActive' => $isActive);

    if($id > 0)
        $query = $fpdo->update('attraction')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('attraction')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();

    header('Location: /admin/attraction.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);
    $query = $fpdo->deleteFrom('attraction')->where('id', $id);
    $query->execute();

    header('Location: /admin/attraction.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $attraction = $fpdo->from('attraction')->where(array('id' => $id ))->fetch();
        if ($attraction) {
            echo $twig->render('/admin/attractionEdit.html.twig', array('attraction' => $attraction));
        }
        else
            echo $twig->render('/admin/attractionEdit.html.twig');
    }
    else
        echo $twig->render('/admin/attractionEdit.html.twig');

}
else{
    $attraction = $fpdo->from('attraction')->fetchAll();

    echo $twig->render('/admin/attraction.html.twig', array('attraction' => $attraction));
}
