<?php

namespace Controllers;


class Orders
{
    public function getOrders($data=false , $type = false)
    {
        $id = $data{0};
        $result = \Models\Orders::getOrder($id);
        $result = \Response::typeData($result,$type);
        echo $result;
    }

    public function postOrders( $data=false , $type = false)
    {
        $result = \Models\Orders::addCart();
        $results = \Response::typeData($result,'.json');
        echo $results;
    }
}