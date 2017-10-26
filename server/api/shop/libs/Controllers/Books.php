<?php

namespace Controllers;


class Books extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getBooks ($data = false,$type = false)
    {
        try{
            if($data[1] === null )
            {
                $result = \Models\Books::findAllBooks();
                $result = \Response::filterBooks($result);
                $result = \Response::typeData($result,$type);
                return \Response::ServerSuccess(200, $result);
            }
            else
            {
                $result = \Models\Books::findByidBooks($data[0]);
                $result = \Response::filterBooks($result);
                $result = \Response::typeData($result,$type);
                return \Response::ServerSuccess(200, $result);
            }
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

    public function postBooks ($data = false)
    {
        try{
        $title = $this->valid->clearData($_POST['title']);
        $price = $this->valid->clearData($_POST['price']);
        $description = $this->valid->clearData($_POST['description']);
        $discount = $this->valid->clearData($_POST['discount']);
        $active = $this->valid->clearData($_POST['active']);
        $result = \Models\Books::addBook($title, $price, $description, $discount, $active);
        $result = \Response::typeData($result,'.json');
        return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }
    public function putBooks($data = false)
    {
        try{
        $putParams = json_decode(file_get_contents("php://input"), true);
        $id = $this->valid->clearData($putParams['id']);
        $title = $this->valid->clearData($putParams['title']);
        $price = $this->valid->clearData($putParams['price']);
        $description = $this->valid->clearData($putParams['description']);
        $discount = $this->valid->clearData($putParams['discount']);
        $active = $this->valid->clearData($putParams['active']);
        $result = \Models\Books::updateBook($title,$price,$description,$discount,$active,$id);
            return \Response::ServerSuccess(200, 'ok');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function deleteBooks($data = false)
    {
        return false;
    }

}