<?php

namespace Models;

class Models
{

    public static function findAll()
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table,
            []
        );
        return $data;
    }

    public static function findByid($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE id=:id',
            [':id' => $id]
        );
        return $data[0];
		//?? false;
    }

    public static function addAuthor($name)
    {
        $sql = "INSERT INTO " . static::$table . " (name) VALUES ('$name')";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

    public static function editAuthor($id,$name)
    {
        $sql = "UPDATE " . static::$table . " SET name = '$name' WHERE id = '$id'" ;
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

    public static function delAuthor($id)
    {
        $sql = "DELETE FROM " . static::$table . " WHERE id = '$id'" ;
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

}