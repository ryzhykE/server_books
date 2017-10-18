<?php

namespace Models;


class Client extends Models
{
    public static $table = 'client';
    public $id;
    public $first_name;
    public $last_name;
    public $login;
    public $pass;
    public $discount;
    public $hash;
    public $role;
    public $active;




    public static function authUser($first_name,$last_name,$login,$pass)
    {
        $pass = md5(md5(trim($pass)));
        $sql = "INSERT INTO  " . static::$table ." ( first_name,last_name,login, pass)
                VALUES ('$first_name', '$last_name', '$login', '$pass' )";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

    public static function loginUser($login)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE login=:login',
            [':login' => $login]
        );
        return $data[0];
        //?? false;
    }

    public function checkUsers($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * , discount FROM ' . static::$table . ' WHERE id=:id',
            [':id' => $id]
        );
        //return = ['discount'=>$data[0]['hash'], 'hash'=>$data[0]['hash'] , 'role'=> $role];
        return $data[0];
        //?? false;
    }

    function generateCode($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length)
        {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
    public static function setHash($id)
    {
        $hash = md5(self::generateCode(10));
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT role FROM ' . static::$table . ' WHERE id=:id',
            [':id' => $id]
        );
        $role = $data[0]['role'];
        $sql = "UPDATE " . static::$table . " SET hash = '$hash' WHERE id = '$id' ";
        $result = $db->execute($sql);
        $arr = ['id'=>$id, 'hash'=>$hash , 'role'=> $role];
        return json_encode($arr);

    }

}