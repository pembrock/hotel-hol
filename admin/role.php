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
    $descr = $_POST['descr'];
    $is_enabled = $_POST['is_enabled'];
    $sys = $_POST['sys'];

    $set = array('name' => $name, 'descr' => $descr, 'is_enabled' => $is_enabled, 'sys' => $sys);

    if($id > 0)
        $query = $fpdo->update('role')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('role')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
//    if($id == 0){
//        $orderBy = $fpdo->from('settings')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
//        $query = $fpdo->update('settings')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
//        $query->execute();
//    }
    header('Location: /admin/role.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('role')->where('id', $id);
    $query->execute();

    header('Location: /admin/role.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $role = $fpdo->from('role')->where(array('id' => $id ))->fetch();
        if ($role) {
            echo $twig->render('/admin/roleEdit.html.twig', array('role' => $role));
        }
        else
            echo $twig->render('/admin/roleEdit.html.twig');
    }
    else
        echo $twig->render('/admin/roleEdit.html.twig');

}
else{
    $role = $fpdo->from('role')->fetchAll();
    echo $twig->render('/admin/role.html.twig', array('role' => $role));
}
