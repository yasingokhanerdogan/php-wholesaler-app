<?php

use App\Models\SettingModel;
use PHPMailer\PHPMailer\PHPMailer;

function config($key, $default = null)
{
    return \Arrilot\DotEnv\DotEnv::get($key, $default);
}

function numberFormat($number)
{
    return number_format($number, "2", ",", ".");
}

function sendMail($type, $qrLink, $user_mail, $user_name)
{

    $settings = SettingModel::find(0);

    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPAuth = true;
    $mail->Host = $settings->smtp_host;
    $mail->Port = $settings->smtp_port;
    $mail->SMTPSecure = 'tls';
    $mail->Username = $settings->smtp_username;
    $mail->Password = base64_decode($settings->smtp_password);
    $mail->SetFrom($mail->Username, 'noreply');
    $mail->AddAddress($user_mail, $user_name);
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    if ($type == "qrlogin"):

        $mail->Subject = "YGE Tekstil QR ile Giriş";
        $message = '<br>Merhaba ' . $user_name . ',<br><br> YGE Tekstil Paneline Giriş Yapmak için Aşağıdaki Tek Kullanımlık Linki Kullanabilirsin: <br><br>' . $qrLink;
        $mail->Body = $message;

    elseif ($type == "qrproduct"):

        $mail->Subject = "YGE Tekstil QR ile Ürün Görüntüleme";
        $message = '<br>Merhaba ' . $user_name . ',<br><br> YGE Tekstil Ürünlerini Üye Girişi Yapmadan Göremezsin! Aşağıdaki Tek Kullanımlık Linke Tıklayarak Oturum Açıp İstediğin Ürüne Yönlendirileceksin! <br><br>' . $qrLink;
        $mail->Body = $message;

    elseif ($type == "resetpassword"):

        $mail->Subject = "YGE Tekstil Şifre Sıfırlama";
        $message = '<br>Merhaba ' . $user_name . '<br><br> YGE Tekstil Yeni Üyelik Şifresi Oluşturmak için Aşağıdaki Tek Kullanımlık Linki Kullanabilirsin: <br><br> Sıfırlama Linki: <br>' . $qrLink;
        $mail->Body = $message;

    endif;

    return $mail->send();
}