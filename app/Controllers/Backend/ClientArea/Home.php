<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\OrderModel;
use App\Models\ProductModel;
use Core\Controller;

class Home extends Controller{

    public function index(){

        $total_product_count = ProductModel::all()->count();
        $pending_orders = OrderModel::where("user_id", $_SESSION["user"]["id"])->where("status", "pending")->get()->count();

        return $this->view("backend.clientArea.home.index", compact("total_product_count", "pending_orders"));
    }
}