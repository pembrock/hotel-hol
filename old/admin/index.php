<?php
/**
 * Created by PhpStorm.
 * User: K. Pasikuta
 * Date: 27.02.2016
 * Time: 17:22
 */

require 'inc/ini.inc.php';
if ($user->is_loggedin())
    header('Location: hotels.php');