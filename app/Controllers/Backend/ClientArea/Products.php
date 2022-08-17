<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Core\Controller;

class Products extends Controller
{

    public function products($page = 1)
    {

        $total = ProductModel::groupBy("product_code")->get()->count();
        $limit = 12;
        $show = $page * $limit - $limit;
        $pageCount = ceil($total / $limit);
        $forlimit = 2;

        $pagination = [
            "pageCount" => (int)$pageCount,
            "forlimit" => $forlimit,
            "page" => $page
        ];

        $products = ProductModel::orderBy("created_at", "DESC")->groupBy("product_code")->skip($show)->take($limit)->get();

        $forOtherProductRank = 0;
        foreach ($products as $product):
            $products[$forOtherProductRank]->otherProducts = ProductModel::where("id", "!=", $product->id)->where("product_code", $product->product_code)->get();
            $forOtherProductRank++;
        endforeach;

        $categories = CategoryModel::where("status", "=", "1")->get();

        return $this->view("backend.clientArea.products.products", compact("categories" ,"products", "pagination"));
    }

    public function detail($slug)
    {

        $productExists = ProductModel::where("slug", $slug)->get()->count();

        if ($productExists > 0):
            $product = ProductModel::where("slug", $slug)->get()->first();

            $product->otherProducts = ProductModel::where("product_code", $product->product_code)->get();

            if ($product->getCategory->status == "1"):
                return $this->view("backend.clientArea.products.detail", compact("product"));
            else:
                redirect(url("404"));
            endif;

        else:
            redirect(url("404"));
        endif;
    }

}