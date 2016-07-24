<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 26.03.2016
 * Time: 22:48
 */

$path = __DIR__ . '/../../public/upload/images/gallery/';
$files_list = array_diff(scandir($path), array('..', '.'));

echo $twig->render('/front/gallery.html.twig', array('path' => '/../../public/upload/images/gallery/', 'images' => $files_list));
