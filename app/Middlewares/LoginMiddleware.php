<?php

namespace App\Middlewares;

use App\Models\UserModel;
use Pecee\Http\Middleware\IMiddleware;

class LoginMiddleware implements IMiddleware{

    public function handle(\Pecee\Http\Request $request): void
    {

        if (isset($_SESSION["user"]["id"])):

            $authUser = UserModel::find($_SESSION["user"]["id"]);

            if ($authUser->role == "admin" || $authUser->role == "staff"):

                redirect(url("backend.admin.home"));

            elseif ($authUser->role == "client"):

                redirect(url("backend.client.home"));

            endif;
        endif;

    }
}