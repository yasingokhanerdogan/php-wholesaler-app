<?php

namespace App\Controllers\Backend;

use Core\Controller;
use Exception;

class Currency extends Controller
{
    public function __construct()
    {
        //$connect_web = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');

        try {

            $path = "http://www.tcmb.gov.tr/kurlar/today.xml";
            $data = file_get_contents($path);
            $connect_web = simplexml_load_string($data);

            if (isset($_SESSION["currency"])):

                if ($_SESSION["currency"] == "USD"):

                    $_SESSION["currencyIcon"] = "$";
                    $_SESSION["currencyValue"] = (string)$connect_web->Currency[0]->BanknoteSelling;

                elseif ($_SESSION["currency"] == "EURO"):

                    $_SESSION["currencyIcon"] = "€";
                    $_SESSION["currencyValue"] = (string)$connect_web->Currency[3]->BanknoteSelling;

                elseif ($_SESSION["currency"] == "TL"):

                    $_SESSION["currencyIcon"] = "₺";
                    $_SESSION["currencyValue"] = "1";

                endif;

            else:

                $_SESSION["currency"] = "USD";
                $_SESSION["currencyIcon"] = "$";
                $_SESSION["currencyValue"] = (string)$connect_web->Currency[0]->BanknoteSelling;

            endif;

        }catch (Exception $e){

            header("Refresh:0");
        }
    }

    public function change($currency){

       if ($currency == "tl"):
           $_SESSION["currency"] = "TL";
       elseif ($currency == "usd"):
           $_SESSION["currency"] = "USD";
       elseif ($currency == "euro"):
           $_SESSION["currency"] = "EURO";
       endif;

        redirect($_SERVER["HTTP_REFERER"]);
    }
}
