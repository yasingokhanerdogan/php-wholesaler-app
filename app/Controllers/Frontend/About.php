<?php

namespace App\Controllers\Frontend;

use App\Models\SettingModel;
use Core\Controller;

class About extends Controller
{
    public function index()
    {
        $settings = SettingModel::find(0);

        return $this->view("frontend.about-us.index", compact("settings"));
    }
}