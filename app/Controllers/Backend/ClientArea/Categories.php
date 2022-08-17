<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Core\Controller;

class Categories extends Controller
{

    public function index($slug, $page = 1)
    {

        $categoryExists = CategoryModel::where("slug", $slug)->get()->count();

        if ($categoryExists > 0):

            $category = CategoryModel::where("slug", $slug)->get()->first();

            $total = ProductModel::groupBy("product_code")->where("category_id", $category->id)->get()->count();
            $limit = 12;
            $show = $page * $limit - $limit;
            $pageCount = ceil($total / $limit);
            $forlimit = 2;

            $pagination = [
                "pageCount" => (int)$pageCount,
                "forlimit" => $forlimit,
                "page" => $page
            ];

            $products = ProductModel::orderBy("created_at", "DESC")->groupBy("product_code")->where("category_id", $category->id)->skip($show)->take($limit)->get();

            $forOtherProductRank = 0;
            foreach ($products as $product):
                $products[$forOtherProductRank]->otherProducts = ProductModel::where("id", "!=", $product->id)->where("product_code", $product->product_code)->get();
                $forOtherProductRank++;
            endforeach;

            $categories = CategoryModel::where("status", "=", "1")->get();

            return $this->view("backend.clientArea.products.category", compact("categories", "products", "pagination"));

        else:
            redirect(url("404"));
        endif;
    }


}