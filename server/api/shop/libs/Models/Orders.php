<?php
/**
 * Created by PhpStorm.
 * User: Evgeniy
 * Date: 18.10.2017
 * Time: 16:48
 */

namespace Models;


class Orders extends Models
{
    public static $table = 'orders';
    public $id;
    public $id_client;
    public $status;
    public $id_payment;
    public $datetime;
    public $total_price;

    public function getOrder($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            "SELECT orders.id, orders.status,orders.date_time,orders.total_price, orders.total_discount,
             client.login, client.id as clien_id, client.last_name, client.first_name, client.discount , payment.name
             FROM orders
             INNER JOIN payment ON orders.id_payment = payment.id
             INNER JOIN client ON orders.id_client = client.id
             WHERE orders.id_client = :id",
            [':id' => $id]
        );
        return $data;
    }

    public function getFullOrder($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            "SELECT orders.id, orders.status,orders.date_time,orders.total_price, orders.total_discount,
             client.login, client.id as clien_id, client.last_name, client.first_name, client.discount , payment.name
             FROM orders
             INNER JOIN payment ON orders.id_payment = payment.id
             INNER JOIN client ON orders.id_client = client.id
             WHERE orders.id_client = :id",
            [':id' => $id]
        );
        return $data;
    }

}