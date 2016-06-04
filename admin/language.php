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
    $name = $_POST['name'];
    $isActive = $_POST['isActive'];

    $set = array('name' => $name, 'isActive' => $isActive);

    if($id > 0)
        $query = $fpdo->update('language')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('language')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
//    if($id == 0){
//        $orderBy = $fpdo->from('hotel')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
//        $query = $fpdo->update('hotel')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
//        $query->execute();
//    }
    header('Location: /admin/language.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('language')->where('id', $id);
    $query->execute();

    header('Location: /admin/language.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $language = $fpdo->from('language')->where(array('id' => $id ))->fetch();

        if ($language) {
            echo $twig->render('/admin/languageEdit.html.twig', array('language' => $language));
        }
        else
            echo $twig->render('/admin/languageEdit.html.twig');
    }
    else
        echo $twig->render('/admin/languageEdit.html.twig');

}
else{
    $language = $fpdo->from('language')->fetchAll();
    echo $twig->render('/admin/language.html.twig', array('language' => $language));
}
