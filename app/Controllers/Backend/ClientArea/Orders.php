<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\PaymentNoticeModel;
use App\Models\ProductModel;
use Core\Controller;
use Exception;

class Orders extends Controller
{

    public function index()
    {

        return $this->view("backend.clientArea.orders.index");
    }

    public function orderArea()
    {

        $orders = OrderModel::orderBy("id", "DESC")->where("user_id", $_SESSION["user"]["id"])->get();

        return $this->view("backend.clientArea.orders.orderArea", compact("orders"));
    }

    public function cancelOrder()
    {

        $orderNo = $_POST["orderNo"];

        $order = OrderModel::where("user_id", $_SESSION["user"]["id"])->where("order_no", $orderNo)->where("status", "!=", "canceled")->get()->first();

        try {

            if ($order->getPaymentNotice->count() == 0):

                $delete = OrderModel::where("order_no", $orderNo)->delete();

                if ($delete):

                    $orderProducts = OrderProductModel::where("order_no", $order->order_no)->get();

                    foreach ($orderProducts as $item):

                        ProductModel::where("id", $item->product_id)->update([
                            "stock" => $item->getProduct->stock + $item->amount
                        ]);

                    endforeach;

                    OrderProductModel::where("order_no", $orderNo)->delete();
                    echo "success";
                else:
                    throw new Exception("İptal İşlemi Sırasında Hata Oluştu!");
                endif;

            else:
                echo "failed";
            endif;

        }catch (Exception $e){

            echo $e->getMessage();
        }
    }

    public function invoice($orderNo)
    {
        $orderControl = OrderModel::where("user_id", $_SESSION["user"]["id"])->where("order_no", $orderNo)->get()->count();

        if ($orderControl <= 0):

            redirect(url("backend.client.orders"));
            die();
        endif;

        $order = OrderModel::where("order_no", $orderNo)->get()->first();

        return $this->view("backend.clientArea.orders.invoice", compact("order"));
    }
}