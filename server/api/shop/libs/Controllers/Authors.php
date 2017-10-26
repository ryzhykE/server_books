<?php

namespace Controllers;


class Authors extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }
    public function getAuthors ($data = false,$type = false)
    {
        try
        {
            $author = \Models\Authors::findAll();
            $result = \Response::typeData($author,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function postAuthors($data = false,$type = false)
    {
        try
        {
            $name = $this->valid->clearData($_POST['name']);
            $author = \Models\Authors::addAuthor($name);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function putAuthors($data = false,$type = false)
    {
        try
        {
        $putParams = json_decode(file_get_contents("php://input"), true);
        $id = $this->valid->clearData($putParams['id']);
        $name = $this->valid->clearData($putParams['name']);
        $author = \Models\Authors::editAuthor($id,$name);
        return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function deleteAuthors($data = false,$type = false)
    {
        try
        {
            $id = $this->valid->clearData($data[0]);
            $author = \Models\Authors::delAuthor($id);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

}