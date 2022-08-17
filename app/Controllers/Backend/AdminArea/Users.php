<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\BankAccountModel;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ContactInboxModel;
use App\Models\FaqModel;
use App\Models\LoginAuthCodes;
use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\PasswordAuthCodes;
use App\Models\PaymentNoticeModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Core\Controller;
use Exception;
use Illuminate\Support\Str;

class Users extends Controller
{

    public function admins()
    {

        return $this->view("backend.adminArea.users.admins");
    }

    public function adminArea()
    {

        $users = UserModel::orderBy("created_at", "DESC")->where("role", "!=", "client")->get();

        return $this->view("backend.adminArea.users.adminArea", compact("users"));
    }

    public function clients()
    {
        return $this->view("backend.adminArea.users.clients");
    }

    public function clientArea()
    {

        $users = UserModel::orderBy("created_at", "DESC")->where("role", "=", "client")->get();

        return $this->view("backend.adminArea.users.clientArea", compact("users"));

    }

    public function add()
    {
        return $this->view("backend.adminArea.users.add");
    }

    public function createAdmin()
    {

        try {

            $userNameExists = UserModel::where("username", Str::slug($_POST["username"]))->get()->count();

            if ($userNameExists > 0) :
                echo 'username_already_exists';
                die();
            else :

                $userMailExists = UserModel::where("email", $_POST["email"])->get()->count();

                if ($userMailExists > 0) :
                    echo 'email_already_exists';
                    die();
                else :

                    $userIdentifierExists = UserModel::where("identity_number", $_POST["identity_number"])->get()->count();

                    if ($userIdentifierExists > 0) :
                        echo 'id_already_exists';
                        die();
                    else :

                        $userPhoneExists = UserModel::where("phone", $_POST["phone"])->get()->count();

                        if ($userPhoneExists > 0) :
                            echo 'phone_already_exists';
                            die(); endif;

                    endif;
                endif;
            endif;

            $_POST["username"] = Str::slug($_POST["username"]);
            $_POST["password"] = md5($_POST["password"]);
            $_POST["status"] = "1";
            $_POST["show_price"] = "1";

            $create = UserModel::insert($_POST);

            if ($create) :
                echo 'success';
                die();
            else:
                echo 'failed';
                die();
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }

    }

    public function createClient()
    {


        try {

            $userNameExists = UserModel::where("username", Str::slug($_POST["username"]))->get()->count();

            if ($userNameExists > 0) :
                echo 'username_already_exists';
                die();
            else :

                $userMailExists = UserModel::where("email", $_POST["email"])->get()->count();

                if ($userMailExists > 0) :
                    echo 'email_already_exists';
                    die();
                else :

                    $userIdentifierExists = UserModel::where("identity_number", $_POST["identity_number"])->get()->count();

                    if ($userIdentifierExists > 0) :
                        echo 'id_already_exists';
                        die();
                    else :

                        $userPhoneExists = UserModel::where("phone", $_POST["phone"])->get()->count();

                        if ($userPhoneExists > 0) :
                            echo 'phone_already_exists';
                            die();
                        else :

                            $userTaxExists = UserModel::where("tax_number", $_POST["tax_number"])->get()->count();

                            if ($userTaxExists > 0) :
                                echo 'tax_already_exists';
                                die();
                            endif;

                        endif;

                    endif;
                endif;
            endif;

            $_POST["role"] = "client";
            $_POST["username"] = Str::slug($_POST["username"]);
            $_POST["password"] = md5($_POST["password"]);
            $_POST["status"] = "1";
            $_POST["show_price"] = "1";

            $create = UserModel::insert($_POST);

            if ($create) :
                echo 'success';
                die();
            else:
                echo 'failed';
                die();
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function delete()
    {

        try {

            if ($_POST["deleteUserId"] == $_SESSION["user"]["id"]):
                echo 'active_user_cannot_be_deleted';
                die();
            else:

                $loginAuthCodeExists = LoginAuthCodes::where("user_id", $_POST["deleteUserId"])->get()->count();
                $PassAuthCodeExists = LoginAuthCodes::where("user_id", $_POST["deleteUserId"])->get()->count();
                $cartExists = CartModel::where("user_id", $_POST["deleteUserId"])->get()->count();
                $orderExists = OrderModel::where("user_id", $_POST["deleteUserId"])->get()->count();
                $paymentNoticeExists = PaymentNoticeModel::where("user_id", $_POST["deleteUserId"])->get()->count();

                if ($loginAuthCodeExists > 0): LoginAuthCodes::where("user_id", $_POST["deleteUserId"])->delete(); endif;
                if ($PassAuthCodeExists > 0): PasswordAuthCodes::where("user_id", $_POST["deleteUserId"])->delete(); endif;
                if ($cartExists > 0): CartModel::where("user_id", $_POST["deleteUserId"])->delete(); endif;
                if ($orderExists > 0):

                    OrderModel::where("user_id", $_POST["deleteUserId"])->delete();
                    $orderProductExists = OrderProductModel::where("user_id", $_POST["deleteUserId"])->get()->count();

                    for ($i = 1; $i <= $orderProductExists; $i++):
                        OrderProductModel::where("user_id", $_POST["deleteUserId"])->delete();
                    endfor;
                endif;
                if ($paymentNoticeExists > 0): PaymentNoticeModel::where("user_id", $_POST["deleteUserId"])->delete(); endif;

                $delete = UserModel::where("id", $_POST["deleteUserId"])->delete();

                if ($delete) :
                    echo 'success';
                    die();
                else :
                    echo 'failed';
                    die();
                endif;
            endif;

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $userExists = UserModel::where("id", $id)->get()->count();

        if ($userExists > 0):

            $userData = UserModel::where("id", $id)->get()->first();

            return $this->view("backend.adminArea.users.edit", compact("userData"));
        else:
            redirect(url("404"));
        endif;

    }

    public function updateAdmin()
    {

        try {

            $user_id = $_POST["user_id"];

            $userNameExists = UserModel::where("id", "!=", $user_id)->where("username", Str::slug($_POST["username"]))->get()->count();

            if ($userNameExists > 0) :
                echo 'username_already_exists';
                die();
            else :

                $userMailExists = UserModel::where("id", "!=", $user_id)->where("email", $_POST["email"])->get()->count();

                if ($userMailExists > 0) :
                    echo 'email_already_exists';
                    die();
                else :

                    $userIdentifierExists = UserModel::where("id", "!=", $user_id)->where("identity_number", $_POST["identity_number"])->get()->count();

                    if ($userIdentifierExists > 0) :
                        echo 'id_already_exists';
                        die();
                    else :

                        $userPhoneExists = UserModel::where("id", "!=", $user_id)->where("phone", $_POST["phone"])->get()->count();

                        if ($userPhoneExists > 0) :
                            echo 'phone_already_exists';
                            die(); endif;

                    endif;
                endif;
            endif;

            $_POST["username"] = Str::slug($_POST["username"]);

            if ($_SESSION["user"]["id"] == $user_id):

                $user = UserModel::where("id", $user_id)->get()->first();
                $_POST["role"] = $user->role;
                $_POST["status"] = "1";

            endif;

            unset($_POST["user_id"]);

            $update = UserModel::where("id", $user_id)->update($_POST);

            if ($update) :
                echo 'success';
                die();
            else:
                echo 'failed';
                die();
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function updateClient()
    {

        try {

            $user_id = $_POST["user_id"];

            $userNameExists = UserModel::where("id", "!=", $user_id)->where("username", Str::slug($_POST["username"]))->get()->count();

            if ($userNameExists > 0) :
                echo 'username_already_exists';
                die();
            else :

                $userMailExists = UserModel::where("id", "!=", $user_id)->where("email", $_POST["email"])->get()->count();

                if ($userMailExists > 0) :
                    echo 'email_already_exists';
                    die();
                else :

                    $userIdentifierExists = UserModel::where("id", "!=", $user_id)->where("identity_number", $_POST["identity_number"])->get()->count();

                    if ($userIdentifierExists > 0) :
                        echo 'id_already_exists';
                        die();
                    else :

                        $userPhoneExists = UserModel::where("id", "!=", $user_id)->where("phone", $_POST["phone"])->get()->count();

                        if ($userPhoneExists > 0) :
                            echo 'phone_already_exists';
                            die();
                        else :

                            $userTaxExists = UserModel::where("id", "!=", $user_id)->where("tax_number", $_POST["tax_number"])->get()->count();

                            if ($userTaxExists > 0) :
                                echo 'tax_already_exists';
                                die();
                            endif;

                        endif;

                    endif;
                endif;
            endif;

            $_POST["username"] = Str::slug($_POST["username"]);
            unset($_POST["user_id"]);

            $update = UserModel::where("id", $user_id)->update($_POST);

            if ($update) :
                echo 'success';
                die();
            else:
                echo 'failed';
                die();
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function resetPassword_sendMail()
    {

        $user = UserModel::where("email", $_POST["email"])->get()->first();

        $authCode = uniqid() . $user->id;
        $qrLink = baseUrl . url("frontend.changePassword.resetScreen", ["code" => $authCode]);

        $send = sendMail("resetpassword", $qrLink, $user->email, $user->name . " " . $user->surname);

        if ($send):

            PasswordAuthCodes::where("user_id", $user->id)->delete();
            PasswordAuthCodes::insert(["user_id" => $user->id, "code" => $authCode]);

            echo "success";
        else:

            echo "failed";
        endif;


    }
}