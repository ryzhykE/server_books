<?php

namespace Controllers;


class Genre
{
    public function getGenre ($data = false , $type = false)
    {
        $genre = \Models\Genre::findAll();
        $results = \Response::typeData($genre,$type);
        echo $results;
    }

}