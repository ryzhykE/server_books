<?php

namespace Controllers;


class Cart
{
    public function getCart($data , $type = false)
    {
        try
        {
            $id = $data{0};
            $result = \Models\Cart::getCartParam($id);
            $result = \Response::typeData($result,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }
    public function postCart()
    {
        try
        {
            $result = \Models\Cart::addtoCart();
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ClientError(400, $exception->getMessage());
        }
    }

    public function putCart()
    {
        try
        {
            $putParams = json_decode(file_get_contents("php://input"), true);
            foreach($putParams as $book) {
                if($book["checked"])
                {
                    $result = \Models\Cart::deleteCart($book["c_id"]);
                    return \Response::ServerSuccess(200, 'ok');
                }
                else
                {
                    $result = \Models\Cart::updateCart($book["count"],$book["c_id"]);
                    //return \Response::ServerSuccess(200, 'ok');
                }
            }
        }
        catch(\Exception $exception)
        {
            return \Response::ClientError(400, $exception->getMessage());
        }

    }

        public function deleteCart($data)
        {
            try
            {
            $id = $data[0];
            $result = \Models\Cart::delCart($id);
            }
            catch(\Exception $exception)
            {
                return \Response::ClientError(400, $exception->getMessage());
            }
        }

}