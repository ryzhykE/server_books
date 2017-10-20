<?php

namespace Controllers;


class Payment
{
    public function getPayment ($data = false , $type = false)
    {
        try
        {
            $genre = \Models\Payment::findAll();
            $result = \Response::typeData($genre,$type);
            return \Response::ServerSuccess(200, $result);
        }
        catch(\Exception $exception)
        {
            return \Response::ServerSuccess(500, $exception->getMessage());
        }

    }

}