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
    $title_ru = $_POST['title_ru'];
    $title_us = $_POST['title_us'];
    $title_cn = $_POST['title_cn'];
    $isActive = $_POST['isActive'];
    $description_ru = $_POST['description_ru'];
    $description_us = $_POST['description_us'];
    $description_cn = $_POST['description_cn'];
    $text_ru = $_POST['text_ru'];
    $text_us = $_POST['text_us'];
    $text_cn = $_POST['text_cn'];
    $meta_desc_ru = $_POST['meta_desc_ru'];
    $meta_desc_us = $_POST['meta_desc_us'];
    $meta_desc_cn = $_POST['meta_desc_cn'];
    $meta_key_ru = $_POST['meta_key_ru'];
    $meta_key_us = $_POST['meta_key_us'];
    $meta_key_cn = $_POST['meta_key_cn'];
    $date = new DateTime();


    if (empty($title_ru))
        $error[] = "Введите название";
    if (empty($description_ru))
        $error[] = "Введите описание";
    if (empty($text_ru))
        $error[] = "Введите текст";
    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'description_ru' => $description_ru,  'description_us' => $description_us,  'description_cn' => $description_cn, 'text_ru' => $text_ru,  'text_us' => $text_us,  'text_cn' => $text_cn, 'isActive' => $isActive, 'date' => $date->format('Y-m-d H:i:s'), 'meta_desc_ru' => $meta_desc_ru, 'meta_desc_us' => $meta_desc_us, 'meta_desc_cn' => $meta_desc_cn, 'meta_key_ru' => $meta_key_ru, 'meta_key_us' => $meta_key_us, 'meta_key_cn' => $meta_key_cn);

//Image upload
    if (!empty($_FILES['logo']['name'])){
        if ($id > 0){
            $query = $fpdo->from('information')->select(null)->select('logo')->where('id', $id)->fetch(); //Check 'logo' field in DB
            if(!is_null($query['logo'])) //if not NULL
                unlink('../public/upload/images/logos/' . $query['logo']); //delete old logo file
        }
        $handle = new upload($_FILES['logo']);
        if($handle->uploaded){
            $handle->file_new_name_body   = md5(time());
            $handle->image_resize         = true;
            $handle->image_x              = 450;
            $handle->image_ratio_y        = true;
            $handle->process('../public/upload/images/logos/');
            if (!$handle->processed) {
                echo 'error : ' . $handle->error;
                die();
            }
            else{
                $logo = $handle->file_dst_name;
                $handle->clean();
            }
        }
    }
    //$set = array('title' => $title, 'description' => $description, 'text' => $text, 'isActive' => $isActive, 'date' => $date->format('Y-m-d H:i:s'));
    if ($logo)
        $set['logo'] = $logo;
    if (!$error) {
        if ($id > 0) {
            $query = $fpdo->update('information')->set($set)->where('id', $id);
        } else {
            $query = $fpdo->insertInto('information')->values($set);
        }
        $query->execute();
        $insert_id = $id > 0 ? $id : $pdo->lastInsertId();

        header('Location: /admin/information.php?edit=' . $insert_id);
    }
    else {
        echo $twig->render('/admin/infoEdit.html.twig', array('error' => $error, 'info' => $set));
        die();
    }
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);
    $query = $fpdo->from('information')->select(null)->select('logo')->where('id', $id)->fetch(); //Check 'logo' field in DB
    if(!is_null($query['logo'])) //if not NULL
        unlink('../public/upload/images/logos/' . $query['logo']); //delete old logo file

    $query = $fpdo->deleteFrom('information')->where('id', $id);
    $query->execute();

    header('Location: /admin/information.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $info = $fpdo->from('information')->where(array('id' => $id ))->fetch();
        if ($info) {

            if (!empty($info['logo']) && file_exists('../public/upload/images/logos/' . $info['logo']))
                $info['logo'] = '../public/upload/images/logos/' . $info['logo'];
            else
                $info['logo'] = NULL;
            echo $twig->render('/admin/infoEdit.html.twig', array('info' => $info));
        }
        else
            echo $twig->render('/admin/infoEdit.html.twig');
    }
    else
        echo $twig->render('/admin/infoEdit.html.twig');

}
else{
    $information = $fpdo->from('information')->orderBy('date DESC')->fetchAll();

    echo $twig->render('/admin/information.html.twig', array('information' => $information));
}
