<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\CategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\SettingModel;
use App\Models\UserModel;
use Core\Controller;
use Exception;
use Illuminate\Support\Str;

class Categories extends Controller
{

    public function index()
    {
        return $this->view("backend.adminArea.categories.index");
    }

    public function create()
    {

        try {

            $categoryExists = CategoryModel::where("title", $_POST["title"])->get()->count();

            if ($categoryExists == 0):

                $create = CategoryModel::insert([
                    "title" => $_POST["title"],
                    "slug" => Str::slug($_POST["title"])
                ]);

                if ($create):
                    echo "success";
                else:
                    echo "failed";
                endif;
            else:
                echo "category_already_exists";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function categoryArea()
    {

        $categories = CategoryModel::orderBy("created_at", "DESC")->get();

        return $this->view("backend.adminArea.categories.categoryArea", compact("categories"));
    }

    public function edit($id)
    {

        $category = CategoryModel::where("id", $id)->get()->first();

        return $this->view("backend.adminArea.categories.edit", compact("category"));
    }

    public function update()
    {

        try {

            $categoryExists = CategoryModel::where("id", "!=", $_POST["category_id"])
                ->where("title", "=", $_POST["title"])
                ->get()
                ->count();

            if ($categoryExists == 0):

                $create = CategoryModel::where("id", $_POST["category_id"])->update([
                    "title" => $_POST["title"],
                    "slug" => Str::slug($_POST["title"])
                ]);

                if ($create) {
                    echo "success";
                } else {
                    echo "failed";
                }

            else:
                echo "category_already_exists";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function delete()
    {

        try {

            $productExists = ProductModel::where("category_id", $_POST["category_id"])->get()->count();

            if ($productExists > 0):

                $products = ProductModel::where("category_id", $_POST["category_id"])->get();
                ProductModel::where("category_id", $_POST["category_id"])->delete();

                foreach ($products as $product):
                    ProductImageModel::where("product_id", $product->id)->delete();
                endforeach;

            endif;

            $delete = CategoryModel::where("id", $_POST["category_id"])->delete();

            if ($delete):
                echo "success";
            else:
                echo "failed";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function statusChange()
    {

        try {

            if ($_POST["category_status"] == "1"):

                $update = CategoryModel::where("id", $_POST["category_id"])->update(["status" => "0"]);

            else:

                $update = CategoryModel::where("id", $_POST["category_id"])->update(["status" => "1"]);

            endif;

            if ($update):
                echo "success";
            else:
                echo "failed";
            endif;

        }catch (Exception $e){
            echo $e->getMessage();
        }

    }
}