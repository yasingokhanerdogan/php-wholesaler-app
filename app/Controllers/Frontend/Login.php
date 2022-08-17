<?php

namespace App\Controllers\Frontend;

use App\Models\LoginAuthCodes;
use App\Models\PasswordAuthCodes;
use App\Models\ProductModel;
use App\Models\SettingModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Core\Controller;
use Exception;

class Login extends Controller
{
    public function index()
    {
        $settings = SettingModel::find(0);

        return $this->view("frontend.login.index", compact("settings"));
    }

    public function signin()
    {
        try {

            $user = UserModel::where("username", $_POST["username"])->orwhere("email", $_POST["username"])->get()->first();

            if ($user):

                if ($user->password == md5($_POST["password"])):

                    if ($user->status == "1"):

                        $update = UserModel::where("id", $user->id)->update(["last_login_date" => date("Y-m-d h:i:s"), "last_login_ip" => $_SERVER["REMOTE_ADDR"]]);

                        if ($update):

                            $_SESSION["user"]["id"] = $user->id;
                            $_SESSION["user"]["loginTime"] = date("Y-m-d h:i:s");
                            $_SESSION["user"]["expireTime"] = date("Y-m-d h:i:s", strtotime("+1 day"));

                            echo "success";
                            die();

                        else:
                            echo "failed";
                            die();
                        endif;

                    else:

                        echo "passive";
                        die();

                    endif;

                else:

                    echo "user_not_found";
                    die();

                endif;

            else:

                echo "user_not_found";
                die();

            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }

    }

    public function signout()
    {
        session_destroy();
        redirect(url("frontend.login"));
    }

    public function QRLoginSendMail($id)
    {
        try {
            if (!isset($_SESSION["user"]["id"])):

                $user = UserModel::where("status", "=", "1")->where("id", $id)->get()->first();

                if ($user):

                    $idCodeCount = LoginAuthCodes::where("user_id", $user->id)->get()->count();

                    if ($idCodeCount > 0):
                        LoginAuthCodes::where("user_id", $user->id)->delete();
                    endif;

                    $authCode = uniqid() . $user->id;

                    $qrLink = baseUrl . url("QRLogin", ["code" => $authCode]);

                    $send = sendMail("qrlogin", $qrLink, $user->email, $user->name . " " . $user->surname);

                    if ($send):

                        $data = [
                            'user_id' => $user->id,
                            'code' => $authCode
                        ];

                        LoginAuthCodes::insert($data);

                        redirect(url("notices", ["message" => "giris-linki-gonderildi", "token" => csrf_token(), "user_id" => $user->id]));
                        die();
                    else:
                        redirect(url("notices", ["message" => "giris-linki-gonderilemedi", "token" => csrf_token()]));
                        die();
                    endif;

                else:

                    redirect(url("notices", ["message" => "kullanici-bulunamadi", "token" => csrf_token()]));
                    die();

                endif;
            else:
                if ($_SESSION["user"]["id"] == $id):
                    redirect(url("backend.client.home"));
                else:

                    session_destroy();

                    redirect(url("QRLoginSendMail", ["id" => $id]));
                endif;
            endif;

        } catch (Exception $e) {

            print_r($e->getMessage());
        }
    }

    public function QRLogin($code)
    {
        $user_id = substr($code, 13);

        try {

            if (!isset($_SESSION["user"]["id"])):

                $userCount = UserModel::where("status", "=", "1")->where("id", $user_id)->get()->count();
                $authCodeCount = LoginAuthCodes::where("code", $code)->get()->count();

                if ($userCount > 0):

                    $user = UserModel::where("status", "=", "1")->where("id", $user_id)->get()->first();

                    if ($authCodeCount > 0):

                        $delete = LoginAuthCodes::where("code", $code)->delete();

                        if ($delete):

                            $update = UserModel::where("id", $user->id)->update(["last_login_date" => date('Y-m-d H:i:s'), "last_login_ip" => $_SERVER['REMOTE_ADDR']]);

                            if ($update):
                                $_SESSION["user"]["id"] = $user["id"];
                                $_SESSION["user"]["loginTime"] = date("Y-m-d h:i:s");
                                $_SESSION["user"]["expireTime"] = date("Y-m-d h:i:s", strtotime("+1 day"));

                                redirect(url("backend.client.home"));
                                die();
                            else:
                                throw new Exception("Giriş Başarısız!");
                            endif;
                        else:
                            throw new Exception("Doğrulama Kodu Hatası!");
                        endif;

                    else:

                        redirect(url("notices", ["message" => "link-kullanilmis", "token" => csrf_token()]));
                        die();

                    endif;
                else:

                    if ($authCodeCount > 0):
                        LoginAuthCodes::where("code", $code)->delete();
                    endif;

                    redirect(url("notices", ["message" => "kullanici-bulunamadi", "token" => csrf_token()]));
                    die();

                endif;
            else:
                if ($_SESSION["user"]["id"] == $user_id):
                    redirect(url("backend.client.home"));
                else:
                    session_destroy();
                    redirect(url("QRLogin", ["code" => $code]));
                endif;

                die();
            endif;

        } catch (Exception $e) {

            print_r($e->getMessage());
        }
    }

    public function QRViewProductSendMail($user_id, $product_id)
    {
        try {

            if (isset($_SESSION["user"]["id"])):

                if ($_SESSION["user"]["id"] == $user_id):

                    $product = ProductModel::find($product_id);

                    if ($product):
                        redirect(url("backend.client.product.detail", ["slug" => $product->slug]));
                    else:
                        redirect(url(404));
                    endif;
                else:

                    session_destroy();
                    redirect(url("QRViewProductSendMail", ["user_id" => $user_id, "product_id" => $product_id]));
                endif;


            else:

                $user = UserModel::where("status", "=", "1")->where("id", $user_id)->get()->first();

                if ($user->count() > 0):

                    $idCodeCount = LoginAuthCodes::where("user_id", $user->id)->get()->count();

                    if ($idCodeCount > 0):
                        LoginAuthCodes::where("user_id", $user->id)->delete();
                    endif;

                    $authCode = uniqid() . $user->id;

                    $qrLink = baseUrl . url("QRViewProduct", ["code" => $authCode, "product_id" => $product_id]);

                    $send = sendMail("qrproduct", $qrLink, $user->email, $user->name . " " . $user->surname);

                    if ($send):

                        $data = [
                            'user_id' => $user->id,
                            'code' => $authCode
                        ];

                        LoginAuthCodes::insert($data);

                        redirect(url("notices", ["message" => "urun-linki-gonderildi", "token" => csrf_token(), "user_id" => $user->id]));
                    else:
                        redirect(url("notices", ["message" => "urun-linki-gonderilemedi", "token" => csrf_token()]));
                        die();
                    endif;

                endif;
            endif;

        } catch (Exception $e) {

            print_r($e->getMessage());
        }

    }

    public function QRViewProduct($code, $product_id)
    {

        $user_id = substr($code, 13);

        try {

            $authCodeCount = LoginAuthCodes::where("code", $code)->get()->count();

            if (!isset($_SESSION["user"]["id"])):

                $userCount = UserModel::where("status", "=", "1")->where("id", $user_id)->get()->count();
                $authCodeCount = LoginAuthCodes::where("code", $code)->get()->count();

                if ($userCount > 0):

                    $user = UserModel::where("status", "=", "1")->where("id", $user_id)->get()->first();

                    if ($authCodeCount > 0):

                        $delete = LoginAuthCodes::where("code", $code)->delete();

                        if ($delete):

                            $update = UserModel::where("id", $user->id)->update(["last_login_date" => date('Y-m-d H:i:s'), "last_login_ip" => $_SERVER['REMOTE_ADDR']]);

                            if ($update):

                                $_SESSION["user"]["id"] = $user["id"];
                                $_SESSION["user"]["loginTime"] = date("Y-m-d h:i:s");
                                $_SESSION["user"]["expireTime"] = date("Y-m-d h:i:s", strtotime("+1 day"));

                                $product = ProductModel::find($product_id);

                                if ($product):
                                    redirect(url("backend.client.product.detail", ["slug" => $product->slug]));
                                else:
                                    redirect(url(404));
                                endif;

                            else:
                                throw new Exception("Giriş Başarısız!");
                            endif;
                        else:
                            throw new Exception("Doğrulama Kodu Hatası!");
                        endif;

                    else:

                        redirect(url("notices", ["message" => "link-kullanilmis", "token" => csrf_token()]));
                        die();

                    endif;
                else:

                    if ($authCodeCount > 0):
                        LoginAuthCodes::where("code", $code)->delete();
                    endif;

                    redirect(url("notices", ["message" => "kullanici-bulunamadi", "token" => csrf_token()]));
                    die();

                endif;
            else:

                if ($authCodeCount > 0):

                    $delete = LoginAuthCodes::where("code", $code)->delete();

                    if ($delete):

                        if ($_SESSION["user"]["id"] == $user_id):

                            $product = ProductModel::find($product_id);

                            if ($product):
                                redirect(url("backend.client.product.detail", ["slug" => $product->slug]));
                            else:
                                redirect(url(404));
                            endif;

                        else:

                            session_destroy();
                            redirect(url("QRViewProduct", ["code" => $code, "product_id" => $product_id]));

                        endif;

                    else:

                        throw new Exception("Doğrulama Kodu Hatası!");

                    endif;

                else:
                    redirect(url("notices", ["message" => "link-kullanilmis", "token" => csrf_token()]));
                endif;
            endif;

        } catch (Exception $e) {

            print_r($e->getMessage());
        }

    }

    public function changePassword_emailScreen()
    {
        $settings = SettingModel::find(0);

        return $this->view("frontend.change-password.emailScreen", compact("settings"));
    }

    public function changePassword_resetPasswordSendMail()
    {

        $userCount = UserModel::where("email", $_POST["email"])->get()->count();

        if ($userCount > 0):

            $user = UserModel::where("email", $_POST["email"])->get()->first();

            $authCode = uniqid() . $user->id;
            $qrLink = baseUrl . url("frontend.changePassword.resetScreen", ["code" => $authCode]);

            $send = sendMail("resetpassword", $qrLink, $user->email, $user->name . " " . $user->surname);

            if ($send):

                PasswordAuthCodes::where("user_id", $user->id)->delete();
                PasswordAuthCodes::insert(["user_id" => $user->id, "code" => $authCode]);

                echo url("notices", ["message" => "sifirlama-linki-gonderildi", "token" => csrf_token(), "user_id" => $user->id]);
            else:

                echo url("notices", ["message" => "sifre-sifirlama-linki-gonderilemedi", "token" => csrf_token()]);
            endif;
        else:
            echo url("notices", ["message" => "kullanici-bulunamadi", "token" => csrf_token()]);
        endif;

    }

    public function changePassword_resetScreen($code)
    {
        $user_id = substr($code, 13);

        try {

            $codeExists = PasswordAuthCodes::where("code", $code)->get()->count();

            if ($codeExists > 0):

                $user = UserModel::find($user_id)->count();
                $settings = SettingModel::find(0);

                if ($user > 0):

                    $user = UserModel::find($user_id);

                    return $this->view("frontend.change-password.resetScreen", compact("settings", "user", "code"));

                else:

                    PasswordAuthCodes::where("code", $code)->delete();

                    redirect(url("notices", ["message" => "kullanici-bulunamadi", "token" => csrf_token()]));
                endif;

            else:
                redirect(url("notices", ["message" => "link-kullanilmis", "token" => csrf_token()]));
            endif;

        } catch (Exception $e) {

            print_r($e->getMessage());
        }

    }

    public function changePassword_resetPassword()
    {
        $user_id = substr($_POST["code"], 13);

        $userCount = UserModel::where("status", "=", "1")->where("id", $user_id)->get()->count();
        $authCodeCount = PasswordAuthCodes::where("code", $_POST["code"])->get()->count();

        if ($userCount > 0):

            if ($authCodeCount > 0):

                PasswordAuthCodes::where("code", $_POST["code"])->delete();
                UserModel::where("id", $user_id)->update(["password" => md5($_POST["password"])]);

                session_destroy();

                echo url("notices", ["message" => "sifre-degistirildi", "token" => csrf_token()]);

            else:
                echo url("notices", ["message" => "link-kullanilmis", "token" => csrf_token()]);
            endif;
        else:
            echo url("notices", ["message" => "kullanici-bulunamadi", "token" => csrf_token()]);
        endif;
    }
}