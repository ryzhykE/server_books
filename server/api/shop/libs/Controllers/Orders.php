<?php

namespace Controllers;


class Orders extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getOrders($data=false , $type = false)
    {
        try
        {

            if($data[1] === null )
            {
                $result = \Models\Orders::getAllOrder();
                $result = \Response::typeData($result,$type);
                return \Response::ServerSuccess(200, $result);
            }
            else
            {
                $id = $this->valid->clearData($data{0});
                $result = \Models\Orders::getOrder($id);
                $result = \Response::typeData($result,$type);
                return \Response::ServerSuccess(200, $result);
            }

        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

    public function putOrders($data=false)
    {
        try{
            $putParams = json_decode(file_get_contents("php://input"), true);
            $id = $this->valid->clearData($putParams['id']);
            $status = $this->valid->clearData($putParams['status']);
            $result = \Models\Orders::updateOrder($id,$status);
            return \Response::ServerSuccess(200,'OK');
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