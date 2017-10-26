<?php

namespace Controllers;


class HistoryBook extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function postHistoryBook($data = false,$type = false)
    {
        try
        {
            $title = $this->valid->clearData($_POST['title']);
            $genre = $this->valid->clearData($_POST['genre']);
            $author = $this->valid->clearData($_POST['author']);
            $price = $this->valid->clearData($_POST['price']);
            $author = \Models\HistoryBook::addBooktoHistory($title,$genre,$author,$price);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }



}