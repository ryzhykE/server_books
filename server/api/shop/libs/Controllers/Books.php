<?php

namespace Controllers;


class Books
{
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
        return false;
    }
    public function putBooks($data = false)
    {
        return false;
    }

    public function deleteBooks($data = false)
    {
        return false;
    }

}