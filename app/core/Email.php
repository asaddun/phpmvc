<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Autoload jika menggunakan Composer
class Email
{
    public static function sendEmail($recipientEmail, $subject, $body)
    {
        try {
            $mail = new PHPMailer(true); // Inisialisasi PHPMailer

            // Konfigurasi Server SMTP
            $mail->isSMTP();
            $mail->Host       = Email_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = Email_USER; // Ganti dengan email Anda
            $mail->Password   = Email_PASS; // Gunakan App Password untuk keamanan lebih
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = Email_PORT;

            // Pengaturan Pengirim dan Penerima
            $mail->setFrom(Email_USER, 'Websiteku'); // Ganti dengan email Anda
            $mail->addAddress($recipientEmail); // Ganti dengan email penerima

            // Konten Email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            // $mail->AltBody = 'Isi email jika tidak mendukung HTML';

            $mail->send();
            // Swal::setSwal('Sukses', 'Email berhasil dikirim', 'success');
        } catch (Exception $e) {
            // Swal::setSwal('Gagal', 'Email gagal dikirim', 'error');
            echo $e;
        }
    }
}
