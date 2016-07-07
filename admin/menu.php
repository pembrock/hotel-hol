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
    $isActive = $_POST['isActive'];

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'title_fr' => $title_fr, 'title_es' => $title_es, 'title_vn' => $title_vn, 'title_tr' => $title_tr, 'isActive' => $isActive);

    if($id > 0)
        $query = $fpdo->update('menu')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('menu')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
//    if($id == 0){
//        $orderBy = $fpdo->from('hotel')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
//        $query = $fpdo->update('hotel')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
//        $query->execute();
//    }
    header('Location: /admin/menu.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('menu')->where('id', $id);
    $query->execute();

    header('Location: /admin/menu.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $menu = $fpdo->from('menu')->where(array('id' => $id ))->fetch();

        if ($menu) {
            echo $twig->render('/admin/menuEdit.html.twig', array('menu' => $menu));
        }
        else
            echo $twig->render('/admin/menuEdit.html.twig');
    }
    else
        echo $twig->render('/admin/menuEdit.html.twig');

}
else{
    $menu = $fpdo->from('menu')->fetchAll();
    echo $twig->render('/admin/menu.html.twig', array('menu' => $menu));
}
