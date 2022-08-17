<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\BankAccountModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Core\Controller;

class BankAccounts extends Controller{

    public function index(){

        $bank_accounts = BankAccountModel::all();

        return $this->view("backend.clientArea.bank-accounts.index", compact("bank_accounts"));
    }
}