<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\BankAccountModel;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ContactInboxModel;
use App\Models\FaqModel;
use App\Models\OrderModel;
use App\Models\PaymentNoticeModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\SettingModel;
use App\Models\UserModel;
use Core\Controller;
use Exception;
use Illuminate\Support\Str;

class Products extends Controller
{

    public function index()
    {
        return $this->view("backend.adminArea.products.index");
    }

    public function productArea()
    {

        $products = ProductModel::all();

        return $this->view("backend.adminArea.products.productArea", compact("products"));
    }

    public function add()
    {

        $categories = CategoryModel::all();

        return $this->view("backend.adminArea.products.add", compact("categories"));
    }

    public function create()
    {

        try {

            @$type = $_FILES["images"]["type"];
            @$tmp_name = $_FILES["images"]["tmp_name"];
            @$name = $_FILES["images"]["name"];
            @$size = $_FILES['images']['size'];

            if (count($name) <= 3):

                for ($i = 0; $i < count($name); $i++):
                    if ($size[$i] > (1024 * 1024 * 15)) :
                        echo "the_file_is_too_big";
                        die();
                    endif;
                endfor;


                for ($i = 0; $i < count($name); $i++):
                    if ($type[$i] != "image/png" && $type[$i] != "image/jpg" && $type[$i] != "image/jpeg") :

                        echo "file_type_not_supported";
                        die();
                    endif;
                endfor;

                $discount_rate = $_POST["discount_rate"];
                $real_price = $_POST["real_price"];

                $discounted_price = $real_price - (($real_price / 100) * $discount_rate);

                $data = [
                    'category_id' => $_POST["category_id"],
                    'user_id' => $_SESSION["user"]["id"],
                    'title' => $_POST["title"],
                    'slug' => Str::slug($_POST["title"] . " " . uniqid()),
                    'stock' => $_POST["stock"],
                    'real_price' => $_POST["real_price"],
                    'discounted_price' => $discounted_price,
                    'discount_rate' => $_POST["discount_rate"],
                    'product_code' => $_POST["product_code"],
                    'origin' => $_POST["origin"],
                    'color' => $_POST["color"],
                    'info' => $_POST["info"],
                    'properties' => $_POST["properties"],
                    'description' => $_POST["description"],
                    'shipping_and_returns' => $_POST["shipping_and_returns"]
                ];

                $create = ProductModel::insert($data);

                if ($create) :

                    $imagePath = "/public/backend-assets/uploads/products/";

                    if (!file_exists(__mainDIR__ . $imagePath)) :
                        mkdir(__mainDIR__ . $imagePath, 0777);
                    endif;

                    for ($i = 0; $i < count($name); $i++):

                        $imagefileName = $imagePath . uniqid() . "_" . substr(Str::slug($name[$i]), 0, -3) . "." . substr($name[$i], -3);

                        $lastProduct = ProductModel::orderBy("id", "DESC")->get()->first();

                        $create2 = ProductImageModel::insert([
                            "product_id" => $lastProduct->id,
                            "image" => $imagefileName,
                            "rank" => $i
                        ]);

                        if ($create2):
                            @move_uploaded_file($tmp_name[$i], __mainDIR__ . $imagefileName);
                        endif;

                    endfor;

                    echo 'success';
                    die();

                else :
                    echo 'failed';
                    die();
                endif;
            else:
                echo "max_3_image";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }

    }

    public function delete()
    {

        $delete = ProductModel::where("id", $_POST["product_id"])->delete();

        if ($delete) :

            $productImages = ProductImageModel::where("product_id", $_POST["product_id"])->get();
            foreach ($productImages as $item):
                ProductImageModel::where("product_id", $item->product_id)->delete();
                unlink(__mainDIR__ . $item->image);
            endforeach;

            $cartExists = CartModel::where("product_id", $_POST["product_id"])->get()->count();
            if ($cartExists > 0):
                CartModel::where("product_id", $_POST["product_id"])->delete();
            endif;


            echo json_encode(["status" => "success"]);
            die();

        else :

            echo json_encode(["status" => "failed"]);
            die();

        endif;

    }

    public function edit($id)
    {

        $product = ProductModel::find($id);

        if ($product):
            $categories = CategoryModel::where("id", "!=", $product->getCategory->id)->get();
            $images = ProductImageModel::orderBy("rank", "ASC")->where("product_id", $id)->get();
        else:
            redirect(url("404"));
            die();
        endif;

        return $this->view("backend.adminArea.products.edit", compact("product", "categories", "images"));
    }

    public function update()
    {

        $discount_rate = $_POST["discount_rate"];
        $real_price = $_POST["real_price"];

        $discounted_price = $real_price - (($real_price / 100) * $discount_rate);
        $product = ProductModel::where("id", $_POST["product_id"])->get()->first();

        if ($product->title == $_POST["title"]):
            $slug = $product->slug;
        else:
            $slug = Str::slug($_POST["title"] . " " . uniqid());
        endif;

        $data = [
            'category_id' => $_POST["category_id"],
            'user_id' => $_SESSION["user"]["id"],
            'title' => $_POST["title"],
            'slug' => $slug,
            'stock' => $_POST["stock"],
            'real_price' => $_POST["real_price"],
            'discounted_price' => $discounted_price,
            'discount_rate' => $_POST["discount_rate"],
            'product_code' => $_POST["product_code"],
            'origin' => $_POST["origin"],
            'color' => $_POST["color"],
            'info' => $_POST["info"],
            'properties' => $_POST["properties"],
            'description' => $_POST["description"],
            'shipping_and_returns' => $_POST["shipping_and_returns"]
        ];

        $update = ProductModel::where("id", $_POST["product_id"])->update($data);

        if ($update):
            echo "success";
        else:
            echo "failed";
        endif;
    }

    public function imageSortable()
    {

        $data = $_POST["data"];
        parse_str($data, $order);
        $items = $order["ord"];

        foreach ($items as $rank => $id):

            ProductImageModel::where("id", $id)->update(["rank" => $rank]);

        endforeach;

        echo "success";
    }

    public function deleteImage()
    {

        $image = ProductImageModel::where("id", $_POST["image_id"])->get()->first();
        $delete = ProductImageModel::where("id", $_POST["image_id"])->delete();

        if ($delete):

            unlink(__mainDIR__ . $image->image);
            $imagesAfterDelete = ProductImageModel::orderBy("id", "ASC")->where("product_id", $image->product_id)->get();
            for ($i = 0; $i < count($imagesAfterDelete); $i++):
                ProductImageModel::where("id", $imagesAfterDelete[$i]->id)->update(["rank" => $i]);
            endfor;

            echo "success";
        else:
            echo "failed";
        endif;

    }

    public function createImage()
    {

        try {

            @$type = $_FILES["img"]["type"];
            @$tmp_name = $_FILES["img"]["tmp_name"];
            @$name = $_FILES["img"]["name"];
            @$size = $_FILES['img']['size'];

            $productImagesCount = ProductImageModel::where("product_id", $_POST["product_id"])->get()->count();

            if (3 - $productImagesCount >= count($name)):

                for ($i = 0; $i < count($name); $i++):
                    if ($size[$i] > (1024 * 1024 * 15)) :
                        echo "the_file_is_too_big";
                        die();
                    endif;
                endfor;

                for ($i = 0; $i < count($name); $i++):
                    if ($type[$i] != "image/png" && $type[$i] != "image/jpg" && $type[$i] != "image/jpeg") :

                        echo "file_type_not_supported";
                        die();
                    endif;
                endfor;

                $imagePath = "/public/backend-assets/uploads/products/";

                for ($i = 0; $i < count($name); $i++):

                    $imagefileName = $imagePath . uniqid() . "_" . substr(Str::slug($name[$i]), 0, -3) . "." . substr($name[$i], -3);
                    $productImages = ProductImageModel::orderBy("rank", "DESC")->where("product_id", $_POST["product_id"])->get()->first();

                    $create = ProductImageModel::insert([
                        "product_id" => $_POST["product_id"],
                        "image" => $imagefileName,
                        "rank" => $productImages->rank + 1
                    ]);

                    if ($create):
                        @move_uploaded_file($tmp_name[$i], __mainDIR__ . $imagefileName);
                    endif;


                endfor;

                if ($create):
                    echo "success";
                endif;

            else:
                echo "max_3_image";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }
}