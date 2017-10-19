<?php

namespace Controllers;


class OrderInfo
{
    public function getOrderInfo($data=false , $type = false)
    {
        $id = $data[0];
        $result = \Models\OrderInfo::getFullOrder($id);
        $result = \Response::typeData($result,$type);
        echo $result;
    }

    public function postOrderInfo($data=false , $type = false)
    {

        $result = \Models\OrderInfo::addInfoCart();
    }


}