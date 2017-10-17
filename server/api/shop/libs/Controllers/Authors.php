<?php

namespace Controllers;


class Authors
{
    public function getAuthors ($data = false,$type = false)
    {
        $author = \Models\Authors::findAll();
        $results = \Response::typeData($author,$type);
        echo $results ;
    }

}