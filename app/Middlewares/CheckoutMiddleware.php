<?php

namespace App\Middlewares;

use App\Models\CartModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Pecee\Http\Middleware\IMiddleware;

class CheckoutMiddleware implements IMiddleware
{

    public function handle(\Pecee\Http\Request $request): void
    {

        $cartCount = CartModel::where("user_id", $_SESSION["user"]["id"])->get()->count();

        if ($cartCount == 0):
            redirect(url("backend.client.cart"));
        endif;

    }
}