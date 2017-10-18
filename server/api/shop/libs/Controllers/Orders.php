<?php

namespace Controllers;


class Orders
{
    public function getOrders($data=false , $type = false)
    {
        $id = $data{0};
        $result = \Models\Orders::getOrder(11);
        $result = \Response::typeData($result,$type);
        print_r($result);
    }
}