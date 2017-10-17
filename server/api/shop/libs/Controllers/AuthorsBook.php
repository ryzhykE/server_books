<?php

namespace Controllers;

class AuthorsBook
{
    public function getAuthorsBook ($data = false, $type = false)
    {
        $result = \Models\Authors::findBooktoAuthor($data[0]);
        $result = \Response::filterBooks($result);
        $result = \Response::typeData($result,$type);
        print_r($result);
    }

}