<?php

class Validator
{

    protected function loginValid($data)
    {
        $pattern = '/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/';
        if(preg_match($pattern, $data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    protected function passwordValid($data)
    {
        $pattern = '/^([0-9a-z]{8,10})$/i';
        if(preg_match($pattern, $data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    protected function emailValid($data)
    {
        $pattern = '/[a-Z0-9\._%-]+@[a-Z0-9\.-]+\.[a-Z]{2,4}/';
        if(preg_match($pattern, $data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}