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
    $title_fr = $_POST['title_fr'];
    $title_es = $_POST['title_es'];
    $title_vn = $_POST['title_vn'];
    $title_tr = $_POST['title_tr'];
    $title_de = $_POST['title_de'];
    $isActive = $_POST['isActive'];
    $description_ru = $_POST['description_ru'];
    $description_us = $_POST['description_us'];
    $description_cn = $_POST['description_cn'];
    $description_fr = $_POST['description_fr'];
    $description_es = $_POST['description_es'];
    $description_vn = $_POST['description_vn'];
    $description_tr = $_POST['description_tr'];
    $description_de = $_POST['description_de'];
    $text_ru = $_POST['text_ru'];
    $text_us = $_POST['text_us'];
    $text_cn = $_POST['text_cn'];
    $text_fr = $_POST['text_fr'];
    $text_es = $_POST['text_es'];
    $text_vn = $_POST['text_vn'];
    $text_tr = $_POST['text_tr'];
    $text_de = $_POST['text_de'];
    $meta_desc_ru = $_POST['meta_desc_ru'];
    $meta_desc_us = $_POST['meta_desc_us'];
    $meta_desc_cn = $_POST['meta_desc_cn'];
    $meta_desc_fr = $_POST['meta_desc_fr'];
    $meta_desc_es = $_POST['meta_desc_es'];
    $meta_desc_vn = $_POST['meta_desc_vn'];
    $meta_desc_tr = $_POST['meta_desc_tr'];
    $meta_desc_de = $_POST['meta_desc_de'];
    $meta_key_ru = $_POST['meta_key_ru'];
    $meta_key_us = $_POST['meta_key_us'];
    $meta_key_cn = $_POST['meta_key_cn'];
    $meta_key_fr = $_POST['meta_key_fr'];
    $meta_key_es = $_POST['meta_key_es'];
    $meta_key_vn = $_POST['meta_key_vn'];
    $meta_key_tr = $_POST['meta_key_tr'];
    $meta_key_de = $_POST['meta_key_de'];
    $date = new DateTime();


    if (empty($title_ru))
        $error[] = "Введите название";
    if (empty($description_ru))
        $error[] = "Введите описание";
    if (empty($text_ru))
        $error[] = "Введите текст";
    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'title_fr' => $title_fr, 'title_es' => $title_es, 'title_vn' => $title_vn, 'title_tr' => $title_tr, 'title_de' => $title_de, 'description_ru' => $description_ru,  'description_us' => $description_us, 'description_cn' => $description_cn, 'description_fr' => $description_fr, 'description_es' => $description_es, 'description_vn' => $description_vn, 'description_tr' => $description_tr, 'description_de' => $description_de, 'text_ru' => $text_ru,  'text_us' => $text_us, 'text_cn' => $text_cn, 'text_fr' => $text_fr, 'text_es' => $text_es, 'text_vn' => $text_vn, 'text_tr' => $text_tr, 'text_de' => $text_de, 'isActive' => $isActive, 'date' => $date->format('Y-m-d H:i:s'), 'meta_desc_ru' => $meta_desc_ru, 'meta_desc_us' => $meta_desc_us, 'meta_desc_cn' => $meta_desc_cn, 'meta_desc_fr' => $meta_desc_fr, 'meta_desc_es' => $meta_desc_es, 'meta_desc_vn' => $meta_desc_vn, 'meta_desc_tr' => $meta_desc_tr, 'meta_desc_de' => $meta_desc_de, 'meta_key_ru' => $meta_key_ru, 'meta_key_us' => $meta_key_us, 'meta_key_cn' => $meta_key_cn, 'meta_key_fr' => $meta_key_fr, 'meta_key_es' => $meta_key_es, 'meta_key_vn' => $meta_key_vn, 'meta_key_tr' => $meta_key_tr, 'meta_key_de' => $meta_key_de);

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
