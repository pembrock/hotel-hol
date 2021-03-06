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
    $isActive = isset($_POST['isActive']) ? $_POST['isActive'] : null;


    if (empty($title_ru))
        $error[] = "Введите название";
    if (empty($description_ru))
        $error[] = "Введите описание";

    //Image upload
    if (!empty($_FILES['logo']['name'])){
        if ($id > 0){
            $query = $fpdo->from('additional_service')->select(null)->select('logo')->where('id', $id)->fetch(); //Check 'logo' field in DB
            if(!is_null($query['logo'])) //if not NULL
                unlink('../public/upload/images/logos/' . $query['logo']); //delete old logo file
        }
        $handle = new upload($_FILES['logo']);
        if($handle->uploaded){
            $handle->file_new_name_body   = md5(time());
            $handle->image_resize         = true;
            $handle->image_x              = 300;
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

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'title_fr' => $title_fr, 'title_es' => $title_es, 'title_vn' => $title_vn, 'title_tr' => $title_tr, 'title_de' => $title_de, 'description_ru' => $description_ru,  'description_us' => $description_us, 'description_cn' => $description_cn, 'description_fr' => $description_fr, 'description_es' => $description_es, 'description_vn' => $description_vn, 'description_tr' => $description_tr, 'description_de' => $description_de, 'isActive' => $isActive);
    if ($logo)
        $set['logo'] = $logo;
    if (!$error) {
        if ($id > 0) {
            $query = $fpdo->update('additional_service')->set($set)->where('id', $id);
        } else {
            $query = $fpdo->insertInto('additional_service')->values($set);
        }
        $query->execute();
        $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
        if ($id == 0) {
            $orderBy = $fpdo->from('additional_service')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
            $query = $fpdo->update('additional_service')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id',
                $insert_id);
            $query->execute();
        }
        header('Location: /admin/additional.php?edit=' . $insert_id);
    }
    else {
        echo $twig->render('/admin/additionalEdit.html.twig', array('error' => $error, 'service' => $set));
        die();
    }
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);
    $query = $fpdo->from('additional_service')->select(null)->select('logo')->where('id', $id)->fetch(); //Check 'logo' field in DB
    if(!is_null($query['logo'])) //if not NULL
        unlink('../public/upload/images/logos/' . $query['logo']); //delete old logo file

    $query = $fpdo->deleteFrom('additional_service')->where('id', $id);
    $query->execute();

    header('Location: /admin/additional.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $services = $fpdo->from('additional_service')->where(array('id' => $id ))->fetch();
        if ($services) {
            if (!empty($services['logo']) && file_exists('../public/upload/images/logos/' . $services['logo']))
                $services['logo'] = '../public/upload/images/logos/' . $services['logo'];
            else
                $services['logo'] = NULL;

            echo $twig->render('/admin/additionalEdit.html.twig', array('service' => $services));
        }
        else
            echo $twig->render('/admin/additionalEdit.html.twig');
    }
    else
        echo $twig->render('/admin/additionalEdit.html.twig');

}
else{
    $services = $fpdo->from('additional_service')->fetchAll();
    echo $twig->render('/admin/additional.html.twig', array('services' => $services));
}
