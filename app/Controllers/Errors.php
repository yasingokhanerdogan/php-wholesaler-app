<?php

namespace App\Controllers;

use App\Models\SettingModel;
use Core\Controller;

class Errors extends Controller{

    public function index(){

        $settings = SettingModel::find(0);

        return $this->view("errors.index", compact("settings"));
    }
}