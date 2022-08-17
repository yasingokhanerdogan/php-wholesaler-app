<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\BankAccountModel;
use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\PaymentNoticeModel;
use App\Models\ProductModel;
use Core\Controller;

class Orders extends Controller
{

    public function index()
    {
        return $this->view("backend.adminArea.orders.index");
    }

    public function indexArea()
    {
        $pending_orders = OrderModel::orderBy("created_at", "DESC")->where("status", "=", "pending")->orWhere("status", "=", "paid")->get();

        return $this->view("backend.adminArea.orders.indexArea", compact("pending_orders"));
    }

    public function controlledOrders()
    {
        return $this->view("backend.adminArea.orders.controlled");
    }

    public function controlledArea()
    {
        $controlled_orders = OrderModel::orderBy("created_at", "DESC")->where("status", "=", "controlled")->get();

        return $this->view("backend.adminArea.orders.controlledArea", compact("controlled_orders"));
    }

    public function processedOrders()
    {
        return $this->view("backend.adminArea.orders.processed");
    }

    public function processedArea()
    {
        $processed_orders = OrderModel::orderBy("created_at", "DESC")->where("status", "=", "approved")->orWhere("status", "=", "canceled")->get();

        return $this->view("backend.adminArea.orders.processedArea", compact("processed_orders"));
    }

    public function confirmOrder()
    {

        $update = OrderModel::where("order_no", $_POST["orderNo"])->update(["status" => "approved", "status_description" => "1"]);

        if ($update):
            echo "success";
        else:
            echo "failed";
        endif;
    }

    public function cancelOrder()
    {

        $update = OrderModel::where("id", $_POST["order_id"])->update(["status" => "canceled", "status_description" => $_POST["status_description"]]);

        if ($update):

            $order = OrderModel::where("id", $_POST["order_id"])->get()->first();
            $orderProducts = OrderProductModel::where("order_no", $order->order_no)->get();

            foreach ($orderProducts as $item):

                ProductModel::where("id", $item->product_id)->update([
                    "stock" => $item->getProduct->stock + $item->amount
                ]);

            endforeach;

            echo "success";
        else:
            echo "failed";
        endif;
    }

    public function invoice($orderNo)
    {
        $orderControl = OrderModel::where("order_no", $orderNo)->get()->count();

        if ($orderControl == 0):

            redirect(url("backend.admin.order.pendingOrders"));
            die();
        endif;

        $order = OrderModel::where("order_no", $orderNo)->get()->first();

        return $this->view("backend.adminArea.orders.invoice", compact("order"));
    }

}