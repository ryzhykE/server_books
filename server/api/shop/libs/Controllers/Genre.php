<?php

namespace Controllers;


class Genre
{
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

}