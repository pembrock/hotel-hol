<?php 
if(isset($_POST['file'])){
    $file = '../public/upload/images/logos/' . $_POST['file'];
    if(file_exists($file)){
        unlink($file);
    }
}
?>