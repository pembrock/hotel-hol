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
    $Username = $_POST['Username'];
    $GroupID = $_POST['GroupID'];
    $Email = $_POST['Email'];
    $Activated = isset($_POST['Activated']) ? $_POST['Activated'] : null;
    $Password = $_POST['Password'];
    $savePass = isset($_POST['savePass']) ? $_POST['savePass'] : null;
    $set = array('Username' => $Username, 'GroupID' => $GroupID, 'Activated' => $Activated, 'Email' => $Email);
    if (!empty($Password) && $savePass)
        $set['Password'] = md5($Password);
    if($id > 0)
        $query = $fpdo->update('Users')->set($set)->where('ID', $id);
    else {
        $query = $fpdo->insertInto('Users')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();

    header('Location: /admin/users.php?edit=' . $insert_id);
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('Users')->where('ID', $id);
    $query->execute();

    header('Location: /admin/users.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    $groups = $fpdo->from('groups')->fetchAll();
    if($id > 0){
        $users = $fpdo->from('Users')->where(array('ID' => $id ))->fetch();
        if ($users) {
            echo $twig->render('/admin/usersEdit.html.twig', array('users' => $users, 'groups' => $groups));
        }
        else
            echo $twig->render('/admin/usersEdit.html.twig', array('groups' => $groups));
    }
    else
        echo $twig->render('/admin/usersEdit.html.twig', array('groups' => $groups));

}
else{
    $users = $fpdo->from('Users')->fetchAll();
    echo $twig->render('/admin/users.html.twig', array('users' => $users));
}
