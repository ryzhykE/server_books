<?php

namespace Controllers;


class Authors
{
    public function getAuthors ($data = false,$type = false)
    {
        try
        {
            $author = \Models\Authors::findAll();
            $result = \Response::typeData($author,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }
    }

}