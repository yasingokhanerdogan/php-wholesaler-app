<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\BankAccountModel;
use App\Models\CategoryModel;
use App\Models\ContactInboxModel;
use App\Models\FaqModel;
use App\Models\OrderModel;
use App\Models\PaymentNoticeModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Core\Controller;

class Home extends Controller{

    public function index(){

        $payment_notice_count = PaymentNoticeModel::where("status", "=", "pending")->get()->count();
        $pending_order_count = OrderModel::where("status", "=", "paid")->orWhere("status", "=", "pending")->get()->count();
        $contact_inbox_count = ContactInboxModel::all()->count();
        $category_count = CategoryModel::all()->count();
        $user_count = UserModel::all()->count();
        $bank_account_count = BankAccountModel::all()->count();
        $faq_count = FaqModel::all()->count();
        $product_count = ProductModel::all()->count();


        return $this->view("backend.adminArea.home.index", compact("payment_notice_count", "pending_order_count", "contact_inbox_count", "category_count", "user_count", "bank_account_count", "faq_count", "product_count"));
    }
}