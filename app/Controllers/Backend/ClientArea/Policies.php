<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\OrderModel;
use App\Models\ProductModel;
use Core\Controller;

class Policies extends Controller{

    public function privacyPolicy(){
        return $this->view("backend.clientArea.policies.privacyPolicy");
    }

    public function cookiePolicy(){
        return $this->view("backend.clientArea.policies.cookiePolicy");
    }
}