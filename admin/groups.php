<?php

/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 21:37
 */
require 'inc/ini.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $isActive = $_POST['isActive'];

    $set = array('name' => $name, 'name' => $name, 'isActive' => $isActive);

    if ($id > 0)
        $query = $fpdo->update('groups')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('groups')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
//    if($id == 0){
//        $orderBy = $fpdo->from('settings')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
//        $query = $fpdo->update('settings')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
//        $query->execute();
//    }

    $query = $fpdo->deleteFrom('role2group')->where('gid', $id);
    $query->execute();
    foreach ($_POST['roles'] as $key => $value) {
        foreach ($value as $v => $val) {
            $query = $fpdo->insertInto('role2group')->values(array('gid' => $insert_id, 'rid' => $v));
            $query->execute();
        }
    }

    header('Location: /admin/groups.php?edit=' . $insert_id);
}

if (isset($_GET['del'])) {
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('role2group')->where('gid', $id);
    $query->execute();
    $query = $fpdo->deleteFrom('groups')->where('id', $id);
    $query->execute();


    header('Location: /admin/groups.php');
}
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $roles = $fpdo->from('role')->fetchAll();
    if ($id > 0) {
        $groups = $fpdo->from('groups')->where(array('id' => $id))->fetch();
        if ($groups) {
            $g2r = $fpdo->from('role2group')->where(array('gid' => $id))->fetchAll();
            foreach ($g2r as $key => $val){
                $group2roles[$val['rid']] = $val['rid'];
            }
            echo $twig->render('/admin/groupsEdit.html.twig', array('groups' => $groups, 'roles' => $roles, 'g2r' => $group2roles));
        } else
            echo $twig->render('/admin/groupsEdit.html.twig', array('roles' => $roles));
    } else
        echo $twig->render('/admin/groupsEdit.html.twig', array('roles' => $roles));
}
else {
    $groups = $fpdo->from('groups')->fetchAll();
    echo $twig->render('/admin/groups.html.twig', array('groups' => $groups));
}
