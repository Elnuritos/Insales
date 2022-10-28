<?php

namespace  App\Libraries;

use Illuminate\Support\Facades\Http;





class Insale
{


    public function updateProduct($data, $order_id)
    {
        $url = getenv('INSALES_UPDATE_PRODUCT') . 'orders/' . $order_id . '.json';
        $response = Http::post($url,$data)->json();
        return $response;
    }
    public function getOrders()
    {
     // $date=  date("Y-m-d", strtotime('-1 week')) . 'T10:00:00Z';
        //$url = getenv('INSALES_UPDATE_PRODUCT') . "orders.json?fulfillment_status[]=new";
        $url = getenv('INSALES_UPDATE_PRODUCT') . "orders.json?per_page=100";
        $response = Http::get($url)->json();
        return $response;
    }
}
