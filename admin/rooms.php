<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 21:37
 */

require 'inc/ini.inc.php';

if (isset($_POST['sort'])){
    $data = json_decode($_POST['data']);
    foreach ($data as $key => $val)
    {
        $set = array('orderBy' => $key+1);
        $query = $fpdo->update('rooms')->set($set)->where('id', $val);
        $query->execute();
    }
    echo "ok";
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $title_ru = $_POST['title_ru'];
    $title_us = $_POST['title_us'];
    $title_cn = $_POST['title_cn'];
    $title_fr = $_POST['title_fr'];
    $title_es = $_POST['title_es'];
    $title_vn = $_POST['title_vn'];
    $title_tr = $_POST['title_tr'];
    $title_de = $_POST['title_de'];
    $description_ru = $_POST['description_ru'];
    $description_us = $_POST['description_us'];
    $description_cn = $_POST['description_cn'];
    $description_fr = $_POST['description_fr'];
    $description_es = $_POST['description_es'];
    $description_vn = $_POST['description_vn'];
    $description_tr = $_POST['description_tr'];
    $description_de = $_POST['description_de'];
    /*$seats_count = $_POST['seats_count'];*/
    $isActive = isset($_POST['isActive']) ? 1 : 0;
    
    if (empty($title_ru))
        $error[] = "Введите название номера";
    if (empty($description_ru))
        $error[] = "Введите описание номера";

    //Image upload
    if (!empty($_FILES['image']['name'])){
        if ($id > 0){
            $query = $fpdo->from('rooms')->select(null)->select('image')->where('id', $id)->fetch(); //Check 'image' field in DB
            if(!is_null($query['image'])) //if not NULL
                unlink('../public/upload/images/rooms/' . $query['image']); //delete old image file
        }
        $handle = new upload($_FILES['image']);
        if($handle->uploaded){
            $handle->file_new_name_body   = md5(time());
            $handle->image_resize         = true;
            $handle->image_x              = 300;
            $handle->image_ratio_y        = true;
            $handle->process('../public/upload/images/rooms/');
            if (!$handle->processed) {
                echo 'error : ' . $handle->error;
                die();
            }
            else{
                $image = $handle->file_dst_name;
                $handle->clean();
            }
        }
    }

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'title_fr' => $title_fr, 'title_es' => $title_es, 'title_vn' => $title_vn, 'title_tr' => $title_tr, 'title_de' => $title_de, 'description_ru' => $description_ru,  'description_us' => $description_us, 'description_cn' => $description_cn, 'description_fr' => $description_fr, 'description_es' => $description_es, 'description_vn' => $description_vn, 'description_tr' => $description_tr, 'description_de' => $description_de, /*'seats_count' => $seats_count, */'isActive' => $isActive);
    if ($image)
        $set['image'] = $image;
//    $qq = $fpdo->update('rooms')->set(array('title' => $title))->where('id', $id);
//    $qq->execute();
    if (!$error) {
        if ($id > 0) {
            $query = $fpdo->update('rooms')->set($set)->where('id', $id);
        } else {
            $query = $fpdo->insertInto('rooms')->values($set);
        }
        $query->execute();
        $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
        if ($id == 0) {
            $orderBy = $fpdo->from('rooms')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
            $query = $fpdo->update('rooms')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
            $query->execute();
        }
        header('Location: /admin/rooms.php?edit=' . $insert_id);
    }
    else {
        echo $twig->render('/admin/roomEdit.html.twig', array('error' => $error, 'rooms' => $set));
        die();
    }
}
if (isset($_GET['del'])){
    $id = intval($_GET['del']);
    $query = $fpdo->from('rooms')->select(null)->select('image')->where('id', $id)->fetch(); //Check 'image' field in DB
    if(!is_null($query['image'])) //if not NULL
        unlink('../public/upload/images/rooms/' . $query['image']); //delete old image file

    $query = $fpdo->deleteFrom('rooms')->where('id', $id);
    $query->execute();

    header('Location: /admin/rooms.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $rooms = $fpdo->from('rooms')->where(array('id' => $id ))->fetch();
        if ($rooms) {
            if (!empty($rooms['image']) && file_exists('../public/upload/images/rooms/' . $rooms['image']))
                $rooms['image'] = '../public/upload/images/rooms/' . $rooms['image'];
            else
                $rooms['image'] = NULL;
            echo $twig->render('/admin/roomEdit.html.twig', array('rooms' => $rooms));
        }
        else
            echo $twig->render('/admin/roomEdit.html.twig');
    }
    else
        echo $twig->render('/admin/roomEdit.html.twig');

}
else{
    $rooms = $fpdo->from('rooms')->orderBy('orderBy')->fetchAll();
    echo $twig->render('/admin/rooms.html.twig', array('rooms' => $rooms));
}
