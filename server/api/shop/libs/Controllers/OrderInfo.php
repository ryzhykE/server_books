<?php

namespace Controllers;


class OrderInfo extends \Validator
{
    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getOrderInfo($data=false , $type = false)
    {
        try
        {
            $id = $this->valid->clearData($data[0]);
            $result = \Models\OrderInfo::getFullOrder($id);
            $result = \Response::typeData($result,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }
    public function postOrderInfo($data=false , $type = false)
    {
        try
        {
            $result = \Models\OrderInfo::addInfoCart();
            return \Response::ServerSuccess(200, 'ok');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

}