<?php

// load and parse settigns
$settings = parse_ini_file("settings.ini");
$emails = explode(',', $settings['emails']);
$sender = $settings['sender'];

// handle POST request
$tel = $_POST['tel'];

// write tel to callback_requests folder
$fp = fopen(__DIR__."/callback_requests/" . date('d-m-Y--H-i-s') .'--tel--' . $tel . ".txt", "w");
fwrite($fp, "������ ������. �������: $tel ����/����� " . date('d-m-Y--H-i-s'));
fclose($fp);

// send notification mail
foreach ($emails as $email) {
    mail(trim($email), "������ ������ � site.ru �� $tel", "������ ������ � site.ru �� $tel",
	"From: $sender\r\n"
	."Reply-To: $sender\r\n"
	."X-Mailer: PHP/" . phpversion());
}

