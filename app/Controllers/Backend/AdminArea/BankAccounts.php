<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\BankAccountModel;
use App\Models\FaqModel;
use App\Models\UserModel;
use Core\Controller;
use Exception;

class BankAccounts extends Controller
{

    public function index()
    {
        return $this->view("backend.adminArea.bank-accounts.index");
    }

    public function accountsArea()
    {

        $accounts = BankAccountModel::orderBy("created_at", "DESC")->get();

        return $this->view("backend.adminArea.bank-accounts.accountsArea", compact("accounts"));
    }

    public function delete()
    {

        $delete = BankAccountModel::where("id", $_POST["account_id"])->delete();

        if ($delete):
            echo "success";
        else:
            echo "failed";
        endif;
    }

    public function add()
    {

        return $this->view("backend.adminArea.bank-accounts.add");
    }

    public function create()
    {
        $accountExists = BankAccountModel::where("bank_name", $_POST["bank_name"])->orWhere("iban", $_POST["iban"])->get()->count();

        if ($accountExists == 0):

            $create = BankAccountModel::insert($_POST);

            if ($create):
                echo "success";
            else:
                echo "failed";
            endif;
        else:
            echo "account_already_exists";
        endif;

    }

    public function edit($id)
    {

        $account = BankAccountModel::find($id);

        return $this->view("backend.adminArea.bank-accounts.edit", compact("account"));
    }

    public function update()
    {
        $accountExists = BankAccountModel::where("id", "!=", $_POST["account_id"])->where("iban", $_POST["iban"])->get()->count();

        if ($accountExists == 0):

            $update = BankAccountModel::where("id", $_POST["account_id"])->update([
                "bank_name" => $_POST["bank_name"],
                "account_owner" => $_POST["account_owner"],
                "iban" => $_POST["iban"]
            ]);

            if ($update):
                echo "success";
            else:
                echo "failed";
            endif;
        else:
            echo "account_already_exists";
        endif;

    }
}