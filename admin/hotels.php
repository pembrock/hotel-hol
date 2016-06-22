<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 21:37
 */

require 'inc/ini.inc.php';

include('../inc/classes/Uploader.php');

if (isset($_POST['sort'])){
    $data = json_decode($_POST['data']);
    foreach ($data as $key => $val)
    {
        $set = array('orderBy' => $key+1);
        $query = $fpdo->update('hotel')->set($set)->where('id', $val);
        $query->execute();
    }
    echo "ok";
    die();
}
if(isset($_POST['delete']) && isset($_POST['file'])){
    $path = '../public/upload/images/hotel/' . intval($_GET['edit']) . '/overall/';

    $file = $path . $_POST['file'];
    if(file_exists($file)){
        unlink($file);
    }
}

if(isset($_POST['upload'])){
    $path = '../public/upload/images/hotel/' . intval($_GET['edit']) . '/overall/';
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }
    $uploader = new Uploader();
    $data = $uploader->upload($_FILES['files'], array(
        'limit' => 10, //Maximum Limit of files. {null, Number}
        'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
        'required' => false, //Minimum one file is required for upload {Boolean}
        'uploadDir' => $path, //Upload directory {String}
        'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
        'perms' => null, //Uploaded file permisions {null, Number}
        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
        'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
    ));

    if($data['isComplete']){
        $files = $data['data'];
        print_r($files);
    }

    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = $_POST['id'];
    $title_ru = $_POST['title_ru'];
    $title_us = $_POST['title_us'];
    $title_cn = $_POST['title_cn'];
    $online_link = $_POST['online_link'];
    $description_ru = $_POST['description_ru'];
    $description_us = $_POST['description_us'];
    $description_cn = $_POST['description_cn'];
    $phone = $_POST['phone'];
    $phone2 = $_POST['phone2'];
    $email = $_POST['email'];
    $address_ru = $_POST['address_ru'];
    $address_us = $_POST['address_us'];
    $address_cn = $_POST['address_cn'];
    $subway_ru = $_POST['subway_ru'];
    $subway_us = $_POST['subway_us'];
    $subway_cn = $_POST['subway_cn'];
    $maps_link = $_POST['maps_link'];
    $address_description_ru = $_POST['address_description_ru'];
    $address_description_us = $_POST['address_description_us'];
    $address_description_cn = $_POST['address_description_cn'];
    $meta_desc_ru = $_POST['meta_desc_ru'];
    $meta_desc_us = $_POST['meta_desc_us'];
    $meta_desc_cn = $_POST['meta_desc_cn'];
    $meta_key_ru = $_POST['meta_key_ru'];
    $meta_key_us = $_POST['meta_key_us'];
    $meta_key_cn = $_POST['meta_key_cn'];
    if (empty($title_ru))
        $error[] = "Введите название гостиницы";
    if (empty($description_ru))
        $error[] = "Введите описание гостиницы";
    if (empty($phone))
        $error[] = "Введите номер телефона гостиницы";
    if (empty($email))
        $error[] = "Введите e-mail гостиницы";
    if (empty($subway_ru))
        $error[] = "Введите ближайшую станцию метро";

    //Image upload
    if (!empty($_FILES['logo']['name'])){
        if ($id > 0){
            $query = $fpdo->from('hotel')->select(null)->select('logo')->where('id', $id)->fetch(); //Check 'logo' field in DB
            if(!is_null($query['logo'])) //if not NULL
                unlink('../public/upload/images/logos/' . $query['logo']); //delete old logo file
        }
        $handle = new upload($_FILES['logo']);
        if($handle->uploaded){
            $handle->file_new_name_body   = md5(time());
            $handle->image_resize         = true;
            $handle->image_x              = 650;
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

    $set = array('title_ru' => $title_ru, 'title_us' => $title_us, 'title_cn' => $title_cn, 'online_link' => $online_link, 'description_ru' => $description_ru,  'description_us' => $description_us,  'description_cn' => $description_cn, 'phone' => $phone, 'phone2' => $phone2, 'email' => $email, 'address_ru' => $address_ru,  'address_us' => $address_us,  'address_cn' => $address_cn, 'subway_ru' => $subway_ru,  'subway_us' => $subway_us,  'subway_cn' => $subway_cn, 'maps_link' => $maps_link, 'address_description_ru' => $address_description_ru,  'address_description_us' => $address_description_us,  'address_description_cn' => $address_description_cn, 'meta_desc_ru' => $meta_desc_ru, 'meta_desc_us' => $meta_desc_us, 'meta_desc_cn' => $meta_desc_cn, 'meta_key_ru' => $meta_key_ru, 'meta_key_us' => $meta_key_us, 'meta_key_cn' => $meta_key_cn);
        if ($logo) {
            $set['logo'] = $logo;
        }
    if (!$error) {
        if ($id > 0) {
            $query = $fpdo->update('hotel')->set($set)->where('id', $id);
        } else {
            $query = $fpdo->insertInto('hotel')->values($set);
        }
        $query->execute();
        $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
        if ($id == 0) {
            $orderBy = $fpdo->from('hotel')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
            $query = $fpdo->update('hotel')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
            $query->execute();
        }
        header('Location: /admin/hotels.php?edit=' . $insert_id);
    }
    else {
        echo $twig->render('/admin/hotelEdit.html.twig', array('error' => $error, 'hotels' => $set));
        die();
    }
}

if (isset($_GET['del'])){
    $id = intval($_GET['del']);
    $query = $fpdo->from('hotel')->select(null)->select('logo')->where('id', $id)->fetch(); //Check 'logo' field in DB
    if(!is_null($query['logo'])) //if not NULL
        unlink('../public/upload/images/logos/' . $query['logo']); //delete old logo file

    $query = $fpdo->deleteFrom('hotel')->where('id', $id);
    $query->execute();

    header('Location: /admin/hotels.php');
}
if (isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    if($id > 0){
        $hotels = $fpdo->from('hotel')->where(array('id' => $id ))->fetch();

        if ($hotels) {
            if (!empty($hotels['logo']) && file_exists('../public/upload/images/logos/' . $hotels['logo']))
                $hotels['logo'] = '../public/upload/images/logos/' . $hotels['logo'];
            else
                $hotels['logo'] = NULL;
            $path = '../public/upload/images/hotel/' . intval($id) . '/overall/';
            $files_list = @array_diff(scandir($path), array('..', '.'));
            $rooms = $fpdo->from('rooms')->orderBy('orderBy')->fetchAll();
            echo $twig->render('/admin/hotelEdit.html.twig', array('hotels' => $hotels, 'path' => $path, 'images' => $files_list, 'rooms' => $rooms));
        }
        else
            echo $twig->render('/admin/hotelEdit.html.twig');
    }
    else
        echo $twig->render('/admin/hotelEdit.html.twig');

}
else{
    $hotels = $fpdo->from('hotel')->orderBy('orderBy')->fetchAll();
    echo $twig->render('/admin/hotels.html.twig', array('hotels' => $hotels));
}

function onFilesRemoveCallback($removed_files){
    foreach($removed_files as $key=>$value){
        $path = '../public/upload/images/hotel/' . intval($_GET['edit']) . '/overall/';
        $file = $path . $value;
        if(file_exists($file)){
            unlink($file);
        }
    }

    return $removed_files;
}