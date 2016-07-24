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
    $title = $_POST['title'];
    $isActive = $_POST['isActive'];
    $description = $_POST['description'];
    $text = $_POST['text'];
    $date = new DateTime();
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
    $set = array('title' => $title, 'description' => $description, 'text' => $text, 'isActive' => $isActive, 'date' => $date->format('Y-m-d H:i:s'));
    if ($logo)
        $set['logo'] = $logo;
    if($id > 0)
        $query = $fpdo->update('information')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('information')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();

    header('Location: /admin/information.php?edit=' . $insert_id);
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
