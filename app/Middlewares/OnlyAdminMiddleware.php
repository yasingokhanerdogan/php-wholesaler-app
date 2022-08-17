<?php

namespace App\Middlewares;

use App\Models\UserModel;
use Carbon\Carbon;
use Pecee\Http\Middleware\IMiddleware;

class OnlyAdminMiddleware implements IMiddleware
{

    public function handle(\Pecee\Http\Request $request): void
    {

        $authUser = UserModel::find($_SESSION["user"]["id"]);

        if ($authUser->role == "staff"):
                redirect(url("backend.admin.home"));
        endif;


    }
}