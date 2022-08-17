<?php

namespace App\Controllers\Backend\ClientArea;

use App\Models\BankAccountModel;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Core\Controller;
use Exception;
use PDOException;

class Cart extends Controller
{

    public function cart()
    {
        return $this->view("backend.clientArea.cart.cart");
    }

    public function cartArea()
    {
        $cart = CartModel::orderBy("created_at", "ASC")->where("user_id", $_SESSION["user"]["id"])->get();

        if ($cart->count() > 0):

            $sub_total = 0;
            $total_discounted_price = 0;

            foreach ($cart as $item):
                $sub_total += $item->getProduct->real_price * $item->product_amount;
                $total_discounted_price += $item->getProduct->discounted_price * $item->product_amount;
            endforeach;

            $paymentInfo = [
                "sub_total" => $sub_total,
                "total_discount" => $sub_total - $total_discounted_price,
                "tax_total" => ($total_discounted_price / 100) * 18,
                "total" => $total_discounted_price * 1.18
            ];

        else:
            $paymentInfo = [];
        endif;

        return $this->view("backend.clientArea.cart.cartArea", compact("cart", "paymentInfo"));
    }

    public function addToCart()
    {

        try {

            $product = ProductModel::find($_POST["productId"]);
            $userId = $_SESSION["user"]["id"];

            $productId = $product->id;
            $productStock = $product->stock;
            $productAmount = $_POST["productAmount"];

            if ($productAmount != 0) :
                if ($productAmount <= $productStock):

                    $cartProduct = CartModel::where("user_id", $userId)->where("product_id", $productId)->get()->first();

                    if ($cartProduct):

                        $stockControl = $cartProduct->virtual_stock_remaining - $productAmount;

                        if ($stockControl >= 0):

                            $data = [
                                "product_amount" => $cartProduct->product_amount + $productAmount,
                                "virtual_stock_remaining" => $cartProduct->virtual_stock_remaining - $productAmount
                            ];

                            $update = CartModel::where("user_id", $userId)->where("product_id", $productId)->update($data);

                            if (!$update):
                                echo json_encode("failed");
                                die();
                            endif;

                        else:
                            echo json_encode('not_enough_products');
                            die();
                        endif;
                    else:

                        $data = [
                            "user_id" => $userId,
                            "product_id" => $productId,
                            "product_amount" => $productAmount,
                            "virtual_stock_remaining" => $productStock - $productAmount
                        ];

                        $create = CartModel::insert($data);

                        if (!$create):
                            echo json_encode("failed");
                        endif;

                    endif;

                    $totalProductCount = CartModel::where("user_id", $userId)->get()->count();

                    echo json_encode([
                        "status" => "success",
                        "cartCount" => $totalProductCount
                    ]);

                else:
                    echo json_encode('not_enough_products');
                    die();
                endif;

            else:
                echo json_encode("null");
            endif;

        } catch (Exception $e) {

            echo json_encode($e->getMessage());
        }

    }

    public function deleteFromCart()
    {
        $userId = $_SESSION["user"]["id"];

        try {

            $cartProduct = CartModel::where("user_id", $userId)->where("product_id", $_POST["productId"])->get()->first();

            if ($cartProduct->count() > 0) {

                $delete = CartModel::where("user_id", $userId)->where("product_id", $_POST["productId"])->delete();
                $cartCount = CartModel::where("user_id", $userId)->get()->count();

                if ($delete):

                    echo json_encode([
                        "status" => "success",
                        "cartCount" => $cartCount
                    ]);
                    die();
                else:
                    echo json_encode(["status" => "failed"]);
                endif;

            }

        } catch (Exception $e) {

            echo json_encode($e->getMessage());
        }

    }

    public function updateCart()
    {
        unset($_POST["csrf_token"]);
        $userId = $_SESSION["user"]["id"];

        try {

            foreach ($_POST as $key => $value):

                if ($value != 0):

                    $productRankExplode = explode("-", $key);

                    $cart = CartModel::where("user_id", $userId)->where("product_id", $productRankExplode[1])->get()->first();

                    if ($cart->getProduct->stock == 0):

                        $delete = CartModel::where("user_id", $userId)->where("product_id", $productRankExplode[1])->delete();

                    else:

                        if ($cart->getProduct->stock - $value >= 0):

                            $update = CartModel::where("user_id", $userId)->where("product_id", $productRankExplode[1])->update([
                                "product_amount" => $value,
                                "virtual_stock_remaining" => $cart->getProduct->stock - $value
                            ]);

                        else:

                            $update = CartModel::where("user_id", $userId)->where("product_id", $productRankExplode[1])->update([
                                "product_amount" => $cart->getProduct->stock,
                                "virtual_stock_remaining" => 0
                            ]);

                        endif;
                    endif;
                endif;
            endforeach;


            if ($update || $delete):
                redirect(url("backend.client.cart"));
            else:
                throw new Exception($productRankExplode[1] . " ID'li Ürünü Güncelleme Hatası!");
            endif;

        } catch (Exception $e) {

            print_r($e->getMessage());
        }

    }

    public function checkout()
    {
        $cart = CartModel::orderBy("created_at", "ASC")->get();

        $sub_total = 0;
        $total_discounted_price = 0;

        foreach ($cart as $item):
            $sub_total += $item->getProduct->real_price * $item->product_amount;
            $total_discounted_price += $item->getProduct->discounted_price * $item->product_amount;
        endforeach;

        $paymentInfo = [
            "sub_total" => $sub_total,
            "total_discount" => $sub_total - $total_discounted_price,
            "tax_total" => ($total_discounted_price / 100) * 18,
            "total" => $total_discounted_price * 1.18
        ];

        return $this->view("backend.clientArea.cart.checkout", compact("cart", "paymentInfo"));

    }

    public function order()
    {

        try {

            $cart = CartModel::orderBy("created_at", "ASC")->where("user_id", $_SESSION["user"]["id"])->get();

            if ($cart->count() > 0):
                $authUser = UserModel::find($_SESSION["user"]["id"]);

                $sub_total = 0;
                $total_discounted_price = 0;
                $total_product_amount = 0;

                foreach ($cart as $item):

                    if ($item->getProduct->stock - $item->product_amount < 0):
                        echo json_encode(["status" => "not_enough_product"]);
                        die();
                    endif;

                    $total_product_amount += $item->product_amount;
                    $sub_total += $item->getProduct->real_price * $item->product_amount;
                    $total_discounted_price += $item->getProduct->discounted_price * $item->product_amount;
                endforeach;

                $orderNo = strtoupper(uniqid());

                $data = [
                    "order_no" => $orderNo,
                    "user_id" => $authUser->id,
                    "name" => $authUser->name . " " . $authUser->surname,
                    "email" => $authUser->email,
                    "identity_number" => $authUser->identity_number,
                    "phone" => $authUser->phone,
                    "address" => $authUser->address,
                    "status" => "pending",
                    "sub_total" => $sub_total,
                    "total_discounted_price" => $total_discounted_price,
                    "total_discount" => $sub_total - $total_discounted_price,
                    "total_tax" => ($total_discounted_price / 100) * 18,
                    "total_price" => $total_discounted_price * 1.18,
                    "total_product_amount" => $total_product_amount,
                    "ip_address" => $_SERVER["REMOTE_ADDR"]
                ];

                $create = OrderModel::insert($data);

                if ($create):

                    foreach ($cart as $item):

                        ProductModel::where("id", $item->product_id)->update([
                            "stock" => $item->getProduct->stock - $item->product_amount
                        ]);

                        OrderProductModel::insert([
                            "order_no" => $orderNo,
                            "title" => $item->getProduct->title,
                            "color" => $item->getProduct->color,
                            "user_id" => $authUser->id,
                            "product_id" => $item->product_id,
                            "real_price" => $item->getProduct->real_price,
                            "discounted_price" => $item->getProduct->discounted_price,
                            "amount" => $item->product_amount
                        ]);

                    endforeach;

                    CartModel::where("user_id", $_SESSION["user"]["id"])->delete();

                    echo json_encode([
                        "status" => "success",
                        "link" => url("backend.client.cart.orderStatus", ["token" => csrf_token(), "orderNo" => $orderNo])
                    ]);

                else:
                    echo json_encode(["status" => "failed"]);
                endif;

            else:
                echo json_encode(["status" => "failed"]);
            endif;

        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }

    }

    public function orderStatus($token, $orderNo)
    {

        if ($token != csrf_token()):
            redirect(url("backend.clientArea.cart"));
            die();
        endif;

        try {

            $orderExists = OrderModel::where("order_no", $orderNo)->get()->count();

            if ($orderExists > 0):

                $order = OrderModel::where("order_no", $orderNo)->where("user_id", $_SESSION["user"]["id"])->get()->first();

                return $this->view("backend.clientArea.cart.order-status", compact("order"));

            else:
                redirect(url("404"));
            endif;

        } catch (Exception $e) {

            print_r($e->getMessage());
        }

    }
}