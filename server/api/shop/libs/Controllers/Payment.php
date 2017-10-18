<?php

namespace Controllers;


class Payment
{
    public function getPayment ($data = false , $type = false)
    {
        $genre = \Models\Payment::findAll();
        $results = \Response::typeData($genre,$type);
        echo $results;
    }

}