<?php

namespace App\Controllers\Frontend;

use App\Models\ContactInboxModel;
use App\Models\SettingModel;
use Core\Controller;
use Exception;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;

class Contact extends Controller
{
    public function index()
    {
        $settings = SettingModel::find(0);

        return $this->view("frontend.contact.index", compact("settings"));
    }

    public function sendMail()
    {
        try {

            $settings = SettingModel::find(0);

            $response = $_POST["g-recaptcha-response"];
            $secret = $settings->secretkey;
            $remoteip = $_SERVER["REMOTE_ADDR"];

            $captcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");

            $result = json_decode($captcha);
            if ($result->success == 1) {

                $mail = new PHPMailer();
                $mail->IsSMTP();

                $mail->SMTPAuth = true;
                $mail->Host = $settings->smtp_host;
                $mail->Port = $settings->smtp_port;
                $mail->SMTPSecure = 'tls';
                $mail->Username = $settings->smtp_username;
                $mail->Password = base64_decode($settings->smtp_password);
                $mail->SetFrom($mail->Username, $settings->company_name . " Website İletişim Formu Mesajı");
                $mail->AddAddress($settings->contact_smtp_username, $mail->Username);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = $_POST["subject"];
                $mail->isHTML(true);

                $message = $_POST["name"] . "<br>" . $_POST["email"] . "<br><br>" . $_POST["message"];
                $mail->Body = $message;

                $send = $mail->send();

                if ($send):

                    ContactInboxModel::insert([
                        "name" => $_POST["name"],
                        "email" => $_POST["email"],
                        "subject" => $_POST["subject"],
                        "message" => $_POST["message"]
                    ]);

                    echo "success";
                    die();
                else:
                    echo "failed";
                    die();
                endif;

            } else {
                echo "invalid_recaptcha";
            }

        }catch (Exception $e){

            echo $e->getMessage();
        }
    }
}