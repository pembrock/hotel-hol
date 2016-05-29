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
    $value = $_POST['value'];
    $sysname = $_POST['sysname'];

    $set = array('title' => $title, 'value' => $value, 'sysname' => $sysname);

    if($id > 0)
        $query = $fpdo->update('settings')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('settings')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
//    if($id == 0){
//        $orderBy = $fpdo->from('settings')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
//        $query = $fpdo->update('settings')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
//        $query->execute();
//    }
    header('Location: /admin/settings.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('settings')->where('id', $id);
    $query->execute();

    header('Location: /admin/settings.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $settings = $fpdo->from('settings')->where(array('id' => $id ))->fetch();
        if ($settings) {
            echo $twig->render('/admin/settingsEdit.html.twig', array('settings' => $settings));
        }
        else
            echo $twig->render('/admin/settingsEdit.html.twig');
    }
    else
        echo $twig->render('/admin/settingsEdit.html.twig');

}
else{
    $settings = $fpdo->from('settings')->fetchAll();
    echo $twig->render('/admin/settings.html.twig', array('settings' => $settings));
}
