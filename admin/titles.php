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
    $ru = $_POST['ru'];
    $us = $_POST['us'];
    $cn = $_POST['cn'];
    $fr = $_POST['fr'];
    $es = $_POST['es'];
    $vn = $_POST['vn'];
    $tr = $_POST['tr'];
    $de = $_POST['de'];
    $system = $_POST['system'];

    $set = array('ru' => $ru, 'us' => $us, 'cn' => $cn, 'fr' => $fr, 'es' => $es, 'vn' => $vn, 'tr' => $tr, 'de' => $de, 'system' => $system);

    if($id > 0)
        $query = $fpdo->update('titles')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('titles')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();

    header('Location: /admin/titles.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('titles')->where('id', $id);
    $query->execute();

    header('Location: /admin/titles.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $titles = $fpdo->from('titles')->where(array('id' => $id ))->fetch();
        if ($titles) {
            echo $twig->render('/admin/titlesEdit.html.twig', array('titles' => $titles));
        }
        else
            echo $twig->render('/admin/titlesEdit.html.twig');
    }
    else
        echo $twig->render('/admin/titlesEdit.html.twig');

}
else{
    $titles = $fpdo->from('titles')->orderBy('ru')->fetchAll();
    echo $twig->render('/admin/titles.html.twig', array('titles' => $titles));
}
