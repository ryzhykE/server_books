<?php
/**
 * Created by PhpStorm.
 * User: Evgeniy
 * Date: 13.10.2017
 * Time: 11:51
 */

namespace Controllers;


class GenreBook
{


    public function getGenreBook ($data = false, $type = false)
    {
        $results = \Models\Genre::findBooktoGenre($data[0]);
        $results = \Response::filterBooks($results);
        $results = \Response::typeData($results,$type);
        print_r($results);
    }


}