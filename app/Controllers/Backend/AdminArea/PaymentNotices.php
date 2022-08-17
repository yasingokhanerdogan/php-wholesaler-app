<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\BankAccountModel;
use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\PaymentNoticeModel;
use App\Models\ProductModel;
use Core\Controller;

class PaymentNotices extends Controller
{

    public function index()
    {
        return $this->view("backend.adminArea.payment-notices.index");
    }

    public function noticesArea()
    {

        $controlled_payment_notices = PaymentNoticeModel::orderBy("created_at", "DESC")->where("status", "!=", "pending")->get();
        $pending_payment_notices = PaymentNoticeModel::orderBy("created_at", "DESC")->where("status", "=", "pending")->get();

        return $this->view("backend.adminArea.payment-notices.paymentNoticeArea", compact("controlled_payment_notices", "pending_payment_notices"));
    }

    public function confirmPayment()
    {

        $update = PaymentNoticeModel::where("id", $_POST["payment_id"])->update([
            "status" => "controlled",
            "status_description" => "1"
        ]);

        if ($update):

            OrderModel::where("order_no", $_POST["payment_order_no"])->update(["status" => "controlled"]);

            echo "success";
        else:
            echo "failed";
        endif;
    }

    public function cancelPayment()
    {

        $update = PaymentNoticeModel::where("id", $_POST["payment_id"])->update([
            "status" => "canceled",
            "status_description" => $_POST["status_description"]
        ]);

        if ($update):

            if ($_POST["status_description"] == "3"):
                OrderModel::where("order_no", $_POST["payment_order_no"])->update(["status" => "canceled", "status_description" => "3"]);

                $notice = PaymentNoticeModel::where("id", $_POST["payment_id"])->get()->first();
                $orderProducts = OrderProductModel::where("order_no", $notice->order_no)->get();

                foreach ($orderProducts as $item):

                    ProductModel::where("id", $item->product_id)->update([
                        "stock" => $item->getProduct->stock + $item->amount
                    ]);

                endforeach;
            else:
                OrderModel::where("order_no", $_POST["payment_order_no"])->update(["status" => "pending"]);
            endif;

            echo "success";

        else:
            echo "failed";
        endif;
    }
}