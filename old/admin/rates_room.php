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
    $description = $_POST['description'];
    $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : null;
    $isDefault = isset($_POST['isDefault']) ? $_POST['isDefault'] : null;
    if (!empty($_POST['dateRange'])) {
        $date = explode(' - ', $_POST['dateRange']);
        $startTs = new \DateTime($date[0] . ' 00:00:00');
        $stopTs = new \DateTime($date[1] . ' 23:59:59');
    }

    $set = array('title' => $title, 'description' => $description, 'isDefault' => $isDefault, 'isActive' => $isActive, 'start_ts' => isset($startTs) ? $startTs->format('Y-m-d H:i:s') : null, 'stop_ts' => isset($stopTs) ? $stopTs->format('Y-m-d H:i:s') : null, 'type' => 0);

    if($id > 0)
        $query = $fpdo->update('rates')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('rates')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
    if($id == 0){
        $orderBy = $fpdo->from('rates')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
        $query = $fpdo->update('rates')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
        $query->execute();
    }
    header('Location: /admin/rates_room.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('rates')->where('id', $id);
    $query->execute();

    header('Location: /admin/rates_room.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $rates = $fpdo->from('rates')->where(array('id' => $id ))->fetch();
        if ($rates) {
            echo $twig->render('/admin/rates_roomEdit.html.twig', array('rates' => $rates));
        }
        else
            echo $twig->render('/admin/rates_roomEdit.html.twig');
    }
    else
        echo $twig->render('/admin/rates_roomEdit.html.twig');

}
else{
    $rates = $fpdo->from('rates')->fetchAll();
    echo $twig->render('/admin/rates_room.html.twig', array('rates' => $rates));
}
