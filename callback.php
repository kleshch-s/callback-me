<?php

// load and parse settigns
$settings = parse_ini_file("settings.ini");
$emails = explode(',', $settings['emails']);

// handle POST request
$tel = $_POST['tel'];

// write tel to callback_requests folder
$fp = fopen(__DIR__."/callback_requests/" . date('d-m-Y--H-i-s') .'--tel--' . $tel . ".txt", "w");
fwrite($fp, "Запрос звонка. Телефон: $tel Дата/Время " . date('d-m-Y--H-i-s'));
fclose($fp);

// send notification mail
foreach ($emails as $email) {
    mail(trim($email), "Запрос звонка с site.ru на $tel", "Запрос звонка с site.ru на $tel");
}

