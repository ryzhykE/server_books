<?php

namespace Controllers;


class Client extends \Validator
{
    public $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getClient($data = false,$type = false)
    {
        try
        {
            $result = \Models\Client::checkUsers($data[0]);
            $result = \Response::typeData($result,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

    public function postClient($data=false)
    {

        try {
            $login = $this->valid->clearData($_POST['login']);
            $pass = $this->valid->clearData($_POST['pass']);
            $first_name = $this->valid->clearData($_POST['first_name']);
            $last_name = $this->valid->clearData($_POST['last_name']);
            $result = \Models\Client::authUser($first_name, $last_name, $login, $pass);
            if (false === $result) {
                return \Response::ClientError(401, "User with such login already exists ");
            } else {
                return \Response::ServerSuccess(200, "Register success");
            }
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function putClient($data=false)
    {
        try {
            $putParams = json_decode(file_get_contents("php://input"), true);
            $result = \Models\Client::loginUser($putParams['login']);
            if($result)
            {
                if(md5(md5($putParams['pass'])) === $result["pass"] )
                {
                    $result = \Models\Client::setHash($result["id"]);
                    return \Response::ServerSuccess(200, $result);
                }
                else
                {
                    return \Response::ClientError(401, "Wrong password");
                }
            }
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }



    }

}