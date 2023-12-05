<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APPPATH . 'libraries/PHPMailer/src/PHPMailer.php';
require APPPATH . 'libraries/PHPMailer/src/Exception.php';
require APPPATH . 'libraries/PHPMailer/src/SMTP.php';

class Phpmailer_lib {

    public function load() {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com'; // Update with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'webcms46@gmail.com'; // Update with your email
        $mail->Password = '0069674597'; // Update with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        return $mail;
    }
}
