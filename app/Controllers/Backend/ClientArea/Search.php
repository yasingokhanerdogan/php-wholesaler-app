<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\CategoryModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Core\Controller;
use Illuminate\Support\Str;

class Search extends Controller{

    public function index(){
        redirect(url("backend.client.search.results", ["slug" => Str::slug($_POST["search_input"])]));
    }

    public function results($slug, $page = 1){

        $total = ProductModel::groupBy("product_code")->where("slug", 'LIKE', "%$slug%")->get()->count();
        $limit = 12;
        $show = $page * $limit - $limit;
        $pageCount = ceil($total / $limit);
        $forlimit = 2;

        $pagination = [
            "pageCount" => (int)$pageCount,
            "forlimit" => $forlimit,
            "page" => $page
        ];

        $products = ProductModel::orderBy("created_at", "DESC")->groupBy("product_code")->where("slug", 'LIKE', "%$slug%")->skip($show)->take($limit)->get();

        $forOtherProductRank = 0;
        foreach ($products as $product):
            $products[$forOtherProductRank]->otherProducts = ProductModel::where("id", "!=", $product->id)->where("product_code", $product->product_code)->get();
            $forOtherProductRank++;
        endforeach;

        $categories = CategoryModel::where("status", "=", "1")->get();

        return $this->view("backend.clientArea.search.index", compact("categories", "slug", "products", "pagination"));
    }
}