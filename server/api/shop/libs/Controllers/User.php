<?php

namespace Controllers;

class User extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getUser($data = false,$type = false)
    {
        try
        {
            $result = \Models\Client::findAll();
            $result = \Response::typeData($result,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

    public function postUser($data=false)
    {

        try {
            $login = $this->valid->clearData($_POST['login']);
            $pass = $this->valid->clearData($_POST['pass']);
            $first_name = $this->valid->clearData($_POST['first_name']);
            $last_name = $this->valid->clearData($_POST['last_name']);
            $discount = $this->valid->clearData($_POST['discount']);
            $discount = (int)$_POST['discount'];
            $result = \Models\Client::authUserAdm($first_name, $last_name, $login, $pass, $discount);
            if (null === $result or false === $result) {
                return \Response::ClientError(401, "Tty againe");
            } else {
                return \Response::ServerSuccess(200, "Register success");
            }
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function putUser($data=false)
    {
        try{
            $putParams = json_decode(file_get_contents("php://input"), true);
            $id = $this->valid->clearData($putParams['id']);
            $first_name = $this->valid->clearData($putParams['first_name']);
            $last_name = $this->valid->clearData($putParams['last_name']);
            $login = $this->valid->clearData($putParams['login']);
            $pass = $this->valid->clearData($putParams['pass']);
            $discount = $this->valid->clearData($putParams['discount']);
            $role = $this->valid->clearData($putParams['role']);
            $active = $this->valid->clearData($putParams['active']);
            $result = \Models\Client::updateUserAdm($id,$first_name,$last_name,$login,$pass,$discount,$role,$active);
            return \Response::ServerSuccess(200,'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

}