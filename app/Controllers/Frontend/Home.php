<?php

namespace App\Controllers\Frontend;

use App\Models\SettingModel;
use App\Models\SliderModel;
use Core\Controller;
use Illuminate\Database\Capsule\Manager;

class Home extends Controller
{
    public function index()
    {
        $settings = SettingModel::find(0);

        return $this->view("frontend.home.index", compact("settings"));

    }
}