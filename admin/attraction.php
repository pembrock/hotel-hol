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


    if (empty($title_ru))
        $error[] = "Введите название";
    if (empty($text_ru))
        $error[] = "Введите текст";

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'text_ru' => $text_ru,  'text_us' => $text_us,  'text_cn' => $text_cn, 'isActive' => $isActive);

    if (!$error) {
        if ($id > 0) {
            $query = $fpdo->update('attraction')->set($set)->where('id', $id);
        } else {
            $query = $fpdo->insertInto('attraction')->values($set);
        }
        $query->execute();
        $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
        $query = $fpdo->deleteFrom('hotel2attraction')->where('aid', $insert_id);
        $query->execute();
        foreach ($_POST['hotels'] as $key => $value) {
            $set = array('hid' => $value, 'aid' => $insert_id);
            $query = $fpdo->insertInto('hotel2attraction')->values($set);
            $query->execute();
        }
        header('Location: /admin/attraction.php?edit=' . $insert_id);
    }
    else {
        $hotels = $fpdo->from('hotel')->select(null)->select(array('id', 'title_ru'))->fetchAll();
        echo $twig->render('/admin/attractionEdit.html.twig', array('error' => $error, 'attraction' => $set, 'hotels' => $hotels));
        die();
    }
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);
    $query = $fpdo->deleteFrom('attraction')->where('id', $id);
    $query->execute();

    header('Location: /admin/attraction.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    $hotels = $fpdo->from('hotel')->select(null)->select(array('id', 'title_ru'))->fetchAll();
    if($id > 0){
        $attraction = $fpdo->from('attraction')->where(array('id' => $id ))->fetch();
        $h2a = $fpdo->from('hotel2attraction')->select(null)->select(array('hid'))->where(array('aid' => $id))->fetchAll();
        foreach($h2a as $h)
        {
            $ha[$h['hid']] = $h['hid'];
        }
        if ($attraction) {
            echo $twig->render('/admin/attractionEdit.html.twig', array('attraction' => $attraction, 'hotels' => $hotels, 'ha' => $ha));
        }
        else
            echo $twig->render('/admin/attractionEdit.html.twig', array('hotels' => $hotels));
    }
    else
        echo $twig->render('/admin/attractionEdit.html.twig', array('hotels' => $hotels));

}
else{
    $attraction = $fpdo->from('attraction')->fetchAll();
    echo $twig->render('/admin/attraction.html.twig', array('attraction' => $attraction));
}
