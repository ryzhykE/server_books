<?php

namespace Controllers;

class AuthorsBook
{
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

}