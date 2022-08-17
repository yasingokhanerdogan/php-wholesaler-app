<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\UserModel;
use Core\Controller;

class Profile extends Controller
{

    public function index()
    {

        return $this->view("backend.clientArea.profile.index");
    }

    public function updateProfile()
    {

        $update = UserModel::where("id", $_POST["user_id"])->update(["show_price" => $_POST["show_price"]]);

        if ($update):
            echo "success";
            die();
        else:
            echo "failed";
        endif;

    }
}