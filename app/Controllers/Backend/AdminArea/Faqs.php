<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\FaqModel;
use App\Models\UserModel;
use Core\Controller;
use Exception;

class Faqs extends Controller
{

    public function index()
    {
        return $this->view("backend.adminArea.faqs.index");
    }

    public function faqsArea()
    {

        $faqs = FaqModel::orderBy("created_at", "DESC")->get();

        return $this->view("backend.adminArea.faqs.faqsArea", compact("faqs"));
    }

    public function delete()
    {

        $delete = FaqModel::where("id", $_POST["faq_id"])->delete();

        if ($delete):
            echo "success";
        else:
            echo "failed";
        endif;
    }

    public function add()
    {
        return $this->view("backend.adminArea.faqs.add");
    }

    public function create()
    {
        $faqExists = FaqModel::where("question", $_POST["question"])->get()->count();

        if ($faqExists == 0):

            $create = FaqModel::insert($_POST);

            if ($create):
                echo "success";
            else:
                echo "failed";
            endif;
        else:
            echo "question_already_exists";
        endif;

    }

    public function edit($id)
    {

        $faq = FaqModel::find($id);

        return $this->view("backend.adminArea.faqs.edit", compact("faq"));
    }

    public function update()
    {
        $faqExists = FaqModel::where("id", "!=", $_POST["faq_id"])->where("question", $_POST["question"])->get()->count();

        if ($faqExists == 0):

            $update = FaqModel::where("id", $_POST["faq_id"])->update(["question" => $_POST["question"], "answer" => $_POST["answer"]]);

            if ($update):
                echo "success";
            else:
                echo "failed";
            endif;
        else:
            echo "question_already_exists";
        endif;

    }
}