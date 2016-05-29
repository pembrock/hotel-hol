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
    $path = '../public/upload/images/gallery/';

    $file = $path . $_POST['file'];
    if(file_exists($file)){
        unlink($file);
    }
}
if(isset($_POST['upload'])){
    $path = '../public/upload/images/gallery/';
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

$path = '../public/upload/images/gallery/';
$files_list = array_diff(scandir($path), array('..', '.'));
echo $twig->render('/admin/gallery.html.twig', array('images' => $files_list, 'path' => $path));


function onFilesRemoveCallback($removed_files){
    foreach($removed_files as $key=>$value){
        $path = '../public/upload/images/gallery/';
        $file = $path . $value;
        if(file_exists($file)){
            unlink($file);
        }
    }

    return $removed_files;
}