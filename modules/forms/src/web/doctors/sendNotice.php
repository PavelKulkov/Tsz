<?php

/* получатели */
$to= "".$_GET['pacientFio']." <".$_GET['pacientEmail'].">"; //обратите внимание на запятую

/* тема/subject */
$subject = "Уведомление о записи на прием к врачу";

/* сообщение */
$message = 'Текст уведомления!';

/* Для отправки HTML-почты вы можете установить шапку Content-type. */
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

/* дополнительные шапки */
//$headers .= "From: Birthday Reminder <birthday@example.com>\r\n";

/* и теперь отправим из */
if (mail($to, $subject, $message, $headers)) {
 echo "Уведомление успешно отправлено!";
}
