<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\FaqModel;
use Core\Controller;

class Faqs extends Controller{

    public function index(){

        $faqs = FaqModel::orderBy("created_at", "ASC")->get();

        return $this->view("backend.clientArea.faqs.index", compact("faqs"));
    }
}