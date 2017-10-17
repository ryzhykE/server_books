<?php

namespace Controllers;


class Books
{
    public function getBooks ($data = false,$type = false)
    {

        if($data[1] === null )
        {
            $result = \Models\Books::findAllBooks();
            $result = \Response::filterBooks($result);
            $result = \Response::typeData($result,$type);
            print_r($result);
        }
        else
        {
            $result = \Models\Books::findByidBooks($data[0]);
            $result = \Response::filterBooks($result);
            $result = \Response::typeData($result,$type);
            print_r($result);
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