<?php

namespace Controllers;


class AdminBook
{
    public function getAdminBook ($data = false,$type = false)
    {
        try{
            if($data[1] === null )
            {
                $result = \Models\Books::findBookAdmin();
                $result = \Response::filterBooks($result);
                $result = \Response::typeData($result,$type);
                return \Response::ServerSuccess(200, $result);
            }
            else
            {
                $result = \Models\Books::findByidBooksAdmin($data[0]);
                $result = \Response::filterBooks($result);
                $result = \Response::typeData($result,$type);
                return \Response::ServerSuccess(200, $result);
            }

        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

}

