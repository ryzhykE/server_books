<?php

namespace Controllers;

class AuthorsBook extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getAuthorsBook ($data = false, $type = false)
    {
        try
        {
            $result = \Models\Authors::findBooktoAuthor($data[0]);
            $result = \Response::filterBooks($result);
            $result = \Response::typeData($result,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function postAuthorsBook($data = false,$type = false)
    {
        try
        {
            $id_book = $this->valid->clearData($_POST['id_book']);
            $id_author = $this->valid->clearData($_POST['id_author']);
            $result = \Models\Authors::addBookToAuthor($id_book, $id_author);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

}