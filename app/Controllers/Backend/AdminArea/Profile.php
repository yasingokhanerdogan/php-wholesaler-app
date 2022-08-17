<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\UserModel;
use Core\Controller;

class Profile extends Controller{

    public function index(){
        return $this->view("backend.adminArea.profile.index");
    }
}