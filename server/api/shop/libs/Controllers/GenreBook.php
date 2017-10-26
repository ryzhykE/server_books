<?php
/**
 * Created by PhpStorm.
 * User: Evgeniy
 * Date: 13.10.2017
 * Time: 11:51
 */

namespace Controllers;


class GenreBook extends \Validator
{
    protected $valid;

    public function __construct()
    {
        $this->valid = new \Validator();
    }

    public function getGenreBook ($data = false, $type = false)
    {
        try
        {
            $result = \Models\Genre::findBooktoGenre($data[0]);
            $result = \Response::filterBooks($result);
            $result = \Response::typeData($result,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

    public function postGenreBook($data = false,$type = false)
    {
        try
        {
            $id_book = $this->valid->clearData($_POST['id_book']);
            $id_genre = $this->valid->clearData($_POST['id_genre']);
            $result = \Models\Genre::addBookToGenre($id_book, $id_genre);
            return \Response::ServerSuccess(200, 'OK');
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }


}