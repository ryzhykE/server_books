<?php

namespace Models;


class OrderInfo extends Models
{
    public static $table = 'orders_full_info';
    public $id;
    public $id_order;
    public $id_book;
    public $count;

    public function addInfoCart()
    {
        $idOrder = $_POST["id_order"];
        $idBook = $_POST['id_book'];
        $titleBook = $_POST['title_book'];
        $count = $_POST['count'];
        $price = $_POST['price'];
        $discountBook = $_POST['discount_book'];

        $sql = "INSERT INTO orders_full_info (id_order, id_book, title_book, count, price, discount_book)
             VALUES ('$idOrder', '$idBook', '$titleBook', '$count', '$price', '$discountBook')";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

    public function getFullOrder($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            "SELECT *
             FROM orders_full_info
             WHERE id_order = :id",
            [':id' => $id]
        );
        return $data;
    }

}