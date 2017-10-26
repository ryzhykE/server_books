<?php

namespace Controllers;


class Genre extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getGenre ($data = false , $type = false)
    {
        try
        {
            $genre = \Models\Genre::findAll();
            $result = \Response::typeData($genre,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function postGenre($data = false,$type = false)
    {
        try
        {
            $name = $this->valid->clearData($_POST['name']);
            $author = \Models\Genre::addAuthor($name);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function putGenre($data = false,$type = false)
    {
        try
        {
            $putParams = json_decode(file_get_contents("php://input"), true);
            $id = $this->valid->clearData($putParams['id']);
            $name = $this->valid->clearData($putParams['name']);
            $genre = \Models\Genre::editAuthor($id,$name);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function deleteGenre($data = false,$type = false)
    {
        try
        {
            $id = $this->valid->clearData($data[0]);
            $genre = \Models\Genre::delAuthor($id);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }


}