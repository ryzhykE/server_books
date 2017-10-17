<?php

namespace Controllers;


class Client
{

    public function getClient($data = false,$type = false)
    {

        $result = \Models\Client::checkUsers($data[0]);
        echo $result;
    }

    public function postClient($data=false)
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $result = \Models\Client::authUser($first_name,$last_name,$login,$pass);
        if(false === $result)
        {
            echo \Response::ClientError(401, "User with such login already exists ");
        }
        else
        {
            echo \Response::ServerSuccess(200, "OK");
        }
    }

    public function putClient($data=false)
    {
        $putParams = json_decode(file_get_contents("php://input"), true);
        //parse_str(file_get_contents("php://input"), $putParams);


            $result = \Models\Client::loginUser($putParams['login']);

            if($result)
            {
                if(md5(md5($putParams['pass'])) === $result["pass"] )
                {
                    $result = \Models\Client::setHash($result["id"]);
                    echo $result;
                }
                else
                {
                    echo \Response::ClientError(401, "Wrong password");
                }
            }

    }

}