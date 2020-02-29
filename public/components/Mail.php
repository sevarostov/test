<?php


class Mail
{


    public static function send($text)
    {
        $emailTo = 'seva_rostov@mail.ru';
//        $text = pg_escape_string($_POST['text']);

        require ROOT . "/components/PHPMailerAutoload.php";

        $mail = new PHPMailer;

//        $mail->SMTPDebug = 2;                               // Enable verbose debug output
        date_default_timezone_set('Etc/UTC');
        $mail->CharSet = "utf-8";
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
//        $mail->Host = 'server150.hosting.reg.ru';  // Specify main and backup SMTP servers
//        $mail->Host = 'mail.greentransfer.es';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ra@5rm.ru';                 // SMTP username
//        $mail->Username = 'info@greentransfer.es';                 // SMTP username
        $mail->Password = 'alebarda11b';                           // SMTP password
//        $mail->Password = 'ebatKOLOTUN';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
//        $mail->Port = 587;                                    // TCP port to connect to


//        $mail->setFrom('info@greentransfer.es', 'greentransfer.es');

//        $mail->addAddress('ellen@example.com');               // Name is optional
//        $mail->addReplyTo('info@greentransfer.es', 'GreenTransfer');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('rostovsales@gmail.com');

//        $mail->addAttachment('/assets/img/1.jpg');         // Add attachments
        $mail->isHTML(true);                                  // Set email format to HTML


        $htmlBody = ' ';


        $mail->setFrom('ra@5rm.ru', 'Blog Светлана Картыш');
        $mail->addAddress($emailTo);     // Add a recipient
        $mail->Body = $htmlBody;
        $mail->Subject = 'Ежедневная статистика ';


        if (!$mail->send()) {
            $result['0'] = 'warning';
            $result['1'] = 'Message could not be sent./n' . 'Mailer Error: ' . $mail->ErrorInfo;
            print_r($result);
        } else {

            $_SESSION['sended'] = 1;
            $result['0'] = 'success';
            $result['1'] = 'Message successful sended!';
            print_r($result);

        }

    }



    public static function mailOffer($customer_id, $consumer_id)
    {


        $offer = model_products::getOffer($customer_id, $consumer_id);


        if ($offer['host'] == NULL OR $offer['username'] == NULL OR $offer['password'] == NULL OR $offer['prot'] == NULL) {
            $_SESSION['result'] = true;
            $_SESSION['result_type'] = 'danger';
            $_SESSION['result_message'] = "Письмо не отправлено. Проверьте настройки электронной почты продукта.";
            header('Location: /consumers/view/' . $consumer_id);
        }


        if (empty($offer)) {
            $_SESSION['result'] = 'Операция не успешна.';
            return true;
        }


//        $text = pg_escape_string($_POST['text']);

        require_once ROOT . "/components/PHPMailerAutoload.php";

        $mail = new PHPMailer;
//        $mail->SMTPDebug = 2;                               // Enable verbose debug output
        date_default_timezone_set('Etc/UTC');
        $mail->CharSet = "utf-8";
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $offer['host'];  // Specify main and backup SMTP servers
//        $mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
//        $mail->Host = 'server150.hosting.reg.ru';  // Specify main and backup SMTP servers
//        $mail->Host = 'mail.greentransfer.es';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $offer['username'];                 // SMTP username
//        $mail->Username = 'robot@5rm.ru';                 // SMTP username
//        $mail->Username = 'info@greentransfer.es';                 // SMTP username
        $mail->Password = $offer['password'];;                           // SMTP password
//        $mail->Password = '347340';                           // SMTP password
//        $mail->Password = 'ebatKOLOTUN';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $offer['port'];;                                    // TCP port to connect to
//        $mail->Port = 465;                                    // TCP port to connect to
//        $mail->Port = 587;                                    // TCP port to connect to

//        $mail->addStringAttachment($attachment, $attachmentname, 'base64', 'application/pdf');

//        $mail->setFrom('info@greentransfer.es', 'greentransfer.es');

//        $mail->addAddress('ellen@example.com');               // Name is optional
//        $mail->addReplyTo('info@greentransfer.es', 'GreenTransfer');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('rostovsales@gmail.com');

//        $mail->addAttachment('/assets/img/1.jpg');         // Add attachments
        $mail->isHTML(true);                                  // Set email format to HTML


        $mail->Body = " Блог ";

//        $emailTo = 'gg@5rm.ru';
        $emailTo = $offer['email'];

        $mail->setFrom($offer['username'], 'Светлана Картыш');
//        $mail->setFrom('robot@5rm.ru', 'Идентификация ПятьКомнат');
        $mail->addAddress($emailTo);     // Add a recipient
//        $mail->Body = $htmlBody;
        $mail->Subject = $offer['offer_title'];
        $mail->Subject = '[Authenticationbycall.com] Авторизация звонком ';
//        $mail->Subject = $subject;
//        $mail->send();

        if (!$mail->send()) {
            return "Произошла ошибка: " . $mail->ErrorInfo;
        } else {
            $email_type = 1;
            $created_at = date("d-m-Y");
            $readed = 1;

            $result = model_consumers::updateSend($offer['id'], $email_type, $created_at, $readed);

            if ($result) $_SESSION['result'] = 'Успешно отправлено.';
            return true;
        }

//        if (!$mail->send()) {
//            return "Произошла ошибка: " . $mail->ErrorInfo . ' ';
//        } else {
//            return "Письмо успешно успешно отправлено";
//        }
//
//

    }


}