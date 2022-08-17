<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\ContactInboxModel;
use App\Models\UserModel;
use Core\Controller;
use Exception;

class ContactInbox extends Controller{

    public function index(){
        return $this->view("backend.adminArea.contact-inbox.index");
    }

    public function contactInboxArea(){

        $inbox = ContactInboxModel::orderBy("created_at", "DESC")->get();

        return $this->view("backend.adminArea.contact-inbox.inboxArea", compact("inbox"));
    }

    public function delete(){


        try {

            $delete = ContactInboxModel::where("id", $_POST["inbox_id"])->delete();

            if ($delete):
                echo "success";
            else:
                echo "failed";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }

    }
}