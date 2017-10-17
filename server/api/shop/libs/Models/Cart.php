<?php

namespace Models;


class Cart extends Models
{
    public static $table = 'cart';
    public $id;
    public $id_book;
    public $id_client;
    public $count;

    public function addToCart()
    {
        $count =  $_POST['count'];
        $idBook = $_POST['id_book'];
        $idClient = str_replace("\"", "", $_POST['id_client']);

        $db = DB::getInstance();
        $data = $db->query(
            "select count FROM cart WHERE id_book = '$idBook' AND id_client= '$idClient'",
            []
        );
        //var_dump($data);
        if(empty($data))
        {
            $sql = "INSERT INTO cart (id_book, id_client, count) VALUES ('$idBook', '$idClient', '$count')";
            $db = DB::getInstance();
            $result = $db->execute($sql);
            return $result;
        } else
        {
            $count = (int)$data[0]['count']+(int)$count;
            $sql = "UPDATE cart SET count = '$count' WHERE id_book = '$idBook' AND id_client= '$idClient' " ;
            $db = DB::getInstance();
            $result = $db->execute($sql);
            return $result;

        }
    }

    public function getCartParam($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT hash FROM client WHERE id=:id',
            [':id' => $id]
        );
        $data[0]['hash'];
        if(!empty($data[0]['hash']))
        {
            $db = DB::getInstance();
            $data = $db->query(
                "SELECT books.id, books.title, books.price,books.discount, cart.count, cart.id as c_id
                    FROM books
                    INNER JOIN cart
                    ON cart.id_book = books.id
                    WHERE cart.id_client = :id",
                [':id' => $id]);
            return $data;

            if (!$data)
            {
                echo \Response::clientError( 401, "No autorizate" );
            }
        }
        else
        {
            echo \Response::clientError( 401, "No autorizate" );
        }

    }

    public function delCart()
    {
        $id =  $_POST['checked'];
        var_dump($id);
        $db = DB::getInstance();
        $sql = "DELETE FROM " . static::$table . " WHERE id IN ('$id') ";
        $result = $db->execute($sql);
        return $result;

    }




}