<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\BankAccountModel;
use App\Models\OrderModel;
use App\Models\PaymentNoticeModel;
use Core\Controller;
use Exception;

class PaymentNotices extends Controller
{

    public function index()
    {
        return $this->view("backend.clientArea.payment-notices.index");
    }

    public function paymentNoticeArea()
    {

        $payment_notices = PaymentNoticeModel::orderBy("created_at", "DESC")->where("user_id", $_SESSION["user"]["id"])->get();

        return $this->view("backend.clientArea.payment-notices.paymentNoticeArea", compact("payment_notices"));
    }

    public function add()
    {
        $bank_accounts = BankAccountModel::all();

        $orders = OrderModel::where("user_id", $_SESSION["user"]["id"])->where("status", "=", "pending")->get();

        return $this->view("backend.clientArea.payment-notices.add", compact("bank_accounts", "orders"));
    }

    public function create()
    {

        try {

            unset($_POST["csrf_token"]);
            $_POST["status"] = "pending";

            $create = PaymentNoticeModel::insert($_POST);

            if ($create):

                OrderModel::where("order_no", $_POST["order_no"])->update(["status" => "paid"]);

                echo "success";
                die();
            else:
                echo "failed";
                die();
            endif;

        }catch (Exception $e){

            echo $e->getMessage();
        }
    }
}