<?php
/**
 * Created by PhpStorm.
 * User: k.pasikuta
 * Date: 03.06.2016
 * Time: 13:32
 */

require_once "../../recaptchalib.php";

// ваш секретный ключ
$secret = "6LcMqiETAAAAAKZULFDQFO3L4DNVGRXK9d0SsgW8";

// пустой ответ
$response = null;

// проверка секретного ключа
$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
	$response = $reCaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$_POST["g-recaptcha-response"]
	);
}

if ($response != null && $response->success) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = htmlspecialchars($_POST['comment']);
	$hid = intval($_POST['hid']);
	$set = array('name' => $name, 'email' => $email, 'comment' => $comment);
	$query = $fpdo->insertInto('review')->values($set);
	$query->execute();
	echo json_encode(array("ok" => 1));
} else {
	echo json_encode(array("ok" => 0));
}
die();