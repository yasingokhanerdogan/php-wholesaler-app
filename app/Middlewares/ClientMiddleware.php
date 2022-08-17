<?php

namespace App\Middlewares;

use App\Models\UserModel;
use Carbon\Carbon;
use Pecee\Http\Middleware\IMiddleware;

class ClientMiddleware implements IMiddleware
{

    public function handle(\Pecee\Http\Request $request): void
    {

        if (!isset($_SESSION["user"]["id"])):

            redirect(url("frontend.login"));

        else:

            $authUser = UserModel::find($_SESSION["user"]["id"]);

            if ($authUser->status == "0"):

                unset($_SESSION["user"]);
                redirect(url("frontend.login"));

            else:

                if ($authUser->role == "admin" || $authUser->role == "staff"):

                    redirect(url("backend.admin.home"));

                elseif ($authUser->role == "client"):

                    if ($_SESSION["user"]["expireTime"] < date("Y-m-d h:i:s")):

                        unset($_SESSION["user"]);
                        redirect(url("frontend.login"));
                    endif;
                endif;
            endif;
        endif;

    }
}