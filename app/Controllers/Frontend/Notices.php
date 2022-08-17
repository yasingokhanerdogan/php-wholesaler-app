<?php

namespace App\Controllers\Frontend;

use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\SettingModel;
use App\Models\UserModel;
use Core\Controller;

class Notices extends Controller{


    public function index($message, $token, $user_id = null)
    {

        $settings = SettingModel::find(0);
        $user = UserModel::find($user_id);

        if ($token == csrf_token()):

            if ($message == "giris-linki-gonderildi"):

                $_message = "QR Giriş Linki $user->email Adresine Gönderildi!";

            elseif ($message == "giris-linki-gonderilemedi"):

                $_message = "QR Giriş için Link Email Gönderilemedi! Bizimle İletişime Geçin...";

            elseif ($message == "urun-linki-gonderildi"):

                $_message = "Ürüne Görüntülemek için $user->email Adresine Gönderildi!";

            elseif ($message == "urun-linki-gonderilemedi"):

                $_message = "Ürün Görüntülemek için Email Gönderilemedi!";

            elseif ($message == "link-kullanilmis"):

                $_message = "Link Önceden Kullanılmış veya Süresi Dolmuş! Yaptığınız İşlemi Tekrarlayın!";

            elseif ($message == "sifre-sifirlama-linki-gonderilemedi"):

                $_message = "Şifre Sıfırlama Linki Emailinize Gönderilemedi!";

            elseif ($message == "kullanici-bulunamadi"):

                $_message = "Kullanıcı Bulunamadı!";

            elseif ($message == "sifirlama-linki-gonderildi"):

                $_message = "Şifre Sıfırlama Linki $user->email Adresine Gönderildi!";

            elseif ($message == "sifre-degistirildi"):

                $_message = "Şifre Başarıyla Değiştirildi!";

            endif;

            return $this->view("frontend.notices.index", compact("message", "_message", "settings"));

        else:
            redirect(url("404"));
        endif;
    }
}