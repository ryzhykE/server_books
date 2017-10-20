<?php

class Validator
{
    protected $data;
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

    protected function clearData($data)
    {
        $this->value = trim($data);
        $this->value = stripslashes($data);
        $this->value = strip_tags($data);
        $this->value = htmlspecialchars($data);
        return $this->value;
    }

}