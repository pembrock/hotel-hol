<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 28.02.2016
 * Time: 21:37
 */

require 'inc/ini.inc.php';

include('../inc/classes/Uploader.php');
if(isset($_POST['delete']) && isset($_POST['file'])){
    $path = '../public/upload/images/hr/' . intval($_GET['hid']) . '/' . intval($_GET['rid']) . '/';

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
    $title = $_POST['title'];
    $online_link = $_POST['online_link'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $phone2 = $_POST['phone2'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $subway = $_POST['subway'];
    $maps_link = $_POST['maps_link'];
    $address_description = $_POST['address_description'];
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

    $set = array('title' => $title, 'online_link' => $online_link, 'description' => $description, 'phone' => $phone, 'phone2' => $phone2, 'email' => $email, 'address' => $address, 'subway' => $subway, 'maps_link' => $maps_link, 'address_description' => $address_description);
    if ($logo)
        $set['logo'] = $logo;
    if($id > 0)
        $query = $fpdo->update('hotel')->set($set)->where('id', $id);
    else {
        $query = $fpdo->insertInto('hotel')->values($set);
    }
    $query->execute();
    $insert_id = $id > 0 ? $id : $pdo->lastInsertId();
    if($id == 0){
        $orderBy = $fpdo->from('hotel')->select(null)->select('orderBy')->orderBy('orderBy DESC')->limit(1)->fetch();
        $query = $fpdo->update('hotel')->set(array('orderBy' => $orderBy['orderBy'] + 1))->where('id', $insert_id);
        $query->execute();
    }
    header('Location: /admin/hotels.php?edit=' . $insert_id);
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

        $h2r = $fpdo->from('hotel2room')
                    ->leftJoin('rooms ON rooms.id = hotel2room.rid')
                    ->select('rooms.title')
                    ->where(array('hid' => $id))
                    ->orderBy('rooms.orderBy')
                    ->fetchAll();
        if ($hotels) {
            if (!empty($hotels['logo']) && file_exists('../public/upload/images/logos/' . $hotels['logo']))
                $hotels['logo'] = '../public/upload/images/logos/' . $hotels['logo'];
            else
                $hotels['logo'] = NULL;

            echo $twig->render('/admin/hotelEdit.html.twig', array('hotels' => $hotels, 'h2r' => $h2r));
        }
        else
            echo $twig->render('/admin/hotelEdit.html.twig');
    }
    else
        echo $twig->render('/admin/hotelEdit.html.twig');

}
else{
    $hotels = $fpdo->from('hotel')->fetchAll();
    echo $twig->render('/admin/hotels.html.twig', array('hotels' => $hotels));
}
