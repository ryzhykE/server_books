<?php

namespace Controllers;


class Orders
{

    public function getOrders($data=false , $type = false)
    {
        try
        {
            $id = $data{0};
            $result = \Models\Orders::getOrder($id);
            $result = \Response::typeData($result,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

    public function postOrders( $data=false , $type = false)
    {

        $result = \Models\Orders::addCart();
        $result = \Response::typeData($result,'.json');
        return \Response::ServerSuccess(200, $result);
    }

    public function deleteOrders($data)
    {
        $id = $data[0];
        $result = \Models\Cart::delCart($id);
    }


}