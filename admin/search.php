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
    $meta_desc = $_POST['meta_desc'];
    $meta_key = $_POST['meta_key'];

    $set = array('meta_desc' => $meta_desc, 'meta_key' => $meta_key);

    $query = $fpdo->update('search')->set($set)->where('id', $id);

    $query->execute();

    header('Location: /admin/search.php?edit=' . $id);
}


if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);

        $search = $fpdo->from('search')->where(array('id' => $id ))->fetch();
        if ($settings) {
            echo $twig->render('/admin/searchEdit.html.twig', array('search' => $search));
        }
        else
            echo $twig->render('/admin/searchEdit.html.twig');


}
else{
    $search = $fpdo->from('search')->fetchAll();
    echo $twig->render('/admin/search.html.twig', array('search' => $search));
}
