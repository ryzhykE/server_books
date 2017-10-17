<?php

namespace Controllers;


class Cart
{
    public function getCart($data , $type = false)
    {
        $id = $data{0};
        $result = \Models\Cart::getCartParam($id);
        $result = \Response::typeData($result,$type);
        print_r($result);
    }
    public function postCart()
    {
        $result = \Models\Cart::addtoCart();
        if(false === $result)
        {
            echo \Response::ClientError(400, "No add");
        }
    }
    public function deleteCart()
    {
        $id = 2;
        $result = \Models\Cart::delCart($id);
    }

}