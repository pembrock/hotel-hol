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
    $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : null;

    $set = array('isActive' => $isActive);

    $query = $fpdo->update('review')->set($set)->where('id', $id);

    $query->execute();

    header('Location: /admin/review.php');
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);

    $query = $fpdo->deleteFrom('review')->where('id', $id);
    $query->execute();

    header('Location: /admin/review.php');
}

if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $review = $fpdo->from('review')->where(array('id' => $id ))->fetch();
        if ($review) {
            echo $twig->render('/admin/reviewEdit.html.twig', array('review' => $review));
        }
        else
            header('Location: /admin/review.php');
    }
    else
        header('Location: /admin/review.php');

}
else {
    $review = $fpdo->from('review')->fetchAll();
    foreach ($review as $key => $value) {
        $review[$key]['hotel'] = $fpdo->from('hotel')->select(null)->select('title')->where('id', $value['hid'])->fetchColumn();
    }
    echo $twig->render('/admin/review.html.twig', array('review' => $review));
}
