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
    $title = $_POST['title'];
    $text = $_POST['text'];
    $isActive = $_POST['isActive'];
    $system = $_POST['system'];

    $set = array('title' => $title, 'text' => $text, 'isActive' => $isActive, 'system' => $system);

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
