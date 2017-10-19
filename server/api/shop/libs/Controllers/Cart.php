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

    public function putCart()
    {
        $putParams = json_decode(file_get_contents("php://input"), true);
        foreach($putParams as $book) {
            if($book["checked"])

            {
                $result = \Models\Cart::delCart($book["c_id"]);
            }
            else
            {
                $result = \Models\Cart::updateCart($book["count"],$book["c_id"]);
            }

        }

    }

        public function deleteCart($data)
        {
            $id = $data[0];
            $result = \Models\Cart::delCart($id);
        }

}