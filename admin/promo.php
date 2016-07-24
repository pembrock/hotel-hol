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
    $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : null;
    if (!empty($_POST['dateRange'])) {
        $date = explode(' - ', $_POST['dateRange']);
        $startTs = new \DateTime($date[0] . ' 00:00:00');
        $stopTs = new \DateTime($date[1] . ' 23:59:59');
    }

    if (empty($title_ru))
        $error[] = "Введите название акции";
    if (empty($description_ru))
        $error[] = "Введите описание акции";

    //Image upload
    if (!empty($_FILES['image']['name'])){
        if ($id > 0){
            $query = $fpdo->from('promo')->select(null)->select('image')->where('id', $id)->fetch(); //Check 'logo' field in DB
            if(!is_null($query['image'])) //if not NULL
                unlink('../public/upload/images/promo/' . $query['image']); //delete old logo file
        }
        $handle = new upload($_FILES['image']);
        if($handle->uploaded){
            $handle->file_new_name_body   = md5(time());
            $handle->image_resize         = true;
            $handle->image_x              = 300;
            $handle->image_ratio_y        = true;
            $handle->process('../public/upload/images/promo/');
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
    //slide_image upload
    if (!empty($_FILES['slide_image']['name'])){
        if ($id > 0){
            $query = $fpdo->from('promo')->select(null)->select('slide_image')->where('id', $id)->fetch(); //Check 'logo' field in DB
            if(!is_null($query['image'])) //if not NULL
                unlink('../public/upload/images/promo/' . $query['slide_image']); //delete old logo file
        }
        $handle = new upload($_FILES['slide_image']);
        if($handle->uploaded){
            $handle->file_new_name_body   = md5(time());
            //$handle->image_resize         = true;
            //$handle->image_x              = 300;
            //$handle->image_ratio_y        = true;
            $handle->process('../public/upload/images/promo/');
            if (!$handle->processed) {
                echo 'error : ' . $handle->error;
                die();
            }
            else{
                $slide_image = $handle->file_dst_name;
                $handle->clean();
            }
        }
    }
    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'title_fr' => $title_fr, 'title_es' => $title_es, 'title_vn' => $title_vn, 'title_tr' => $title_tr, 'title_de' => $title_de, 'description_ru' => $description_ru, 'description_us' => $description_us, 'description_cn' => $description_cn, 'description_fr' => $description_fr, 'description_es' => $description_es, 'description_vn' => $description_vn, 'description_tr' => $description_tr, 'description_de' => $description_de, 'text_ru' => $text_ru, 'text_us' => $text_us, 'text_cn' => $text_cn, 'text_fr' => $text_fr, 'text_es' => $text_es, 'text_vn' => $text_vn, 'text_tr' => $text_tr, 'text_de' => $text_de, 'isActive' => $isActive, 'start_ts' => isset($startTs) ? $startTs->format('Y-m-d H:i:s') : null, 'stop_ts' => isset($stopTs) ? $stopTs->format('Y-m-d H:i:s') : null, 'meta_desc_ru' => $meta_desc_ru, 'meta_desc_us' => $meta_desc_us, 'meta_desc_cn' => $meta_desc_cn, 'meta_desc_fr' => $meta_desc_fr, 'meta_desc_es' => $meta_desc_es, 'meta_desc_vn' => $meta_desc_vn, 'meta_desc_tr' => $meta_desc_tr, 'meta_desc_de' => $meta_desc_de, 'meta_key_ru' => $meta_key_ru, 'meta_key_us' => $meta_key_us, 'meta_key_cn' => $meta_key_cn, 'meta_key_fr' => $meta_key_fr, 'meta_key_es' => $meta_key_es, 'meta_key_vn' => $meta_key_vn, 'meta_key_tr' => $meta_key_tr, 'meta_key_de' => $meta_key_de);
    if ($image)
        $set['image'] = $image;
    if ($slide_image)
        $set['slide_image'] = $slide_image;
    if (!$error) {
        if ($id > 0) {
            $query = $fpdo->update('promo')->set($set)->where('id', $id);
        } else {
            $query = $fpdo->insertInto('promo')->values($set);
        }
        $query->execute();
        $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
        if ($id == 0) {
            $orderBy = $fpdo->from('promo')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
            $query = $fpdo->update('promo')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
            $query->execute();
        }
        header('Location: /admin/promo.php?edit=' . $insert_id);
    }
    else {
        echo $twig->render('/admin/promoEdit.html.twig', array('error' => $error, 'promo' => $set));
        die();
    }
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);
    $query = $fpdo->from('promo')->select(null)->select('image')->where('id', $id)->fetch(); //Check 'logo' field in DB
    if(!is_null($query['image'])) //if not NULL
        @unlink('../public/upload/images/promo/' . $query['image']); //delete old logo file
    $query = $fpdo->from('promo')->select(null)->select('slide_image')->where('id', $id)->fetch(); //Check 'logo' field in DB
    if(!is_null($query['slide_image'])) //if not NULL
        @unlink('../public/upload/images/promo/' . $query['slide_image']); //delete old logo file
    $query = $fpdo->deleteFrom('promo')->where('id', $id);
    $query->execute();

    header('Location: /admin/promo.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $promo = $fpdo->from('promo')->where(array('id' => $id ))->fetch();
        if ($promo) {
            if (!empty($promo['image']) && file_exists('../public/upload/images/promo/' . $promo['image']))
                $promo['image'] = '../public/upload/images/promo/' . $promo['image'];
            else
                $promo['image'] = NULL;
            if (!empty($promo['slide_image']) && file_exists('../public/upload/images/promo/' . $promo['slide_image']))
                $promo['slide_image'] = '../public/upload/images/promo/' . $promo['slide_image'];
            else
                $promo['slide_image'] = NULL;
            echo $twig->render('/admin/promoEdit.html.twig', array('promo' => $promo));
        }
        else
            echo $twig->render('/admin/promoEdit.html.twig');
    }
    else
        echo $twig->render('/admin/promoEdit.html.twig');

}
else{
    $promo = $fpdo->from('promo')->fetchAll();
    echo $twig->render('/admin/promo.html.twig', array('promo' => $promo));
}
