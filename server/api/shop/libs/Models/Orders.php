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
    public $total_discount;

    public function getOrder($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            "SELECT orders.id, orders.status,orders.date_time,orders.total_price, orders.total_discount,
             client.login, client.id as clien_id, client.last_name, client.first_name, client.discount , payment.name
             FROM orders
             INNER JOIN payment ON orders.id_payment = payment.id
             INNER JOIN client ON orders.id_client = client.id
             WHERE orders.id_client = :id ORDER BY orders.date_time DESC",
            [':id' => $id]
        );
        return $data;
    }

    public function addCart()
    {
        if (empty($_POST["id_client"]))
        {
            echo \Response::ClientError(400, "Empty item in cart");
        }
        $idClient = $_POST["id_client"];
        $idPayment = $_POST['id_payment'];
        $totalDisc = $_POST['total_discount'];
        $totalPrice = $_POST['total_price'];
        $sql = "INSERT INTO orders (id_client, id_payment, total_discount, total_price)
             VALUES ('$idClient', '$idPayment', '$totalDisc', '$totalPrice')";
        $db = DB::getInstance();
        $db->execute($sql);
        $result['id_order'] = $db->lastInsertId();
        return $result;
    }
    public function getAllOrder()
    {
        $db = DB::getInstance();
        $data = $db->query(
            "SELECT orders.id, orders.status,orders.date_time,orders.total_price, orders.total_discount,
             client.login, client.id as clien_id, client.last_name, client.first_name, client.discount , payment.name
             FROM orders
             INNER JOIN payment ON orders.id_payment = payment.id
             INNER JOIN client ON orders.id_client = client.id
            ORDER BY orders.date_time DESC",
            []
        );
        return $data;
    }

    public function updateOrder($id,$status)
    {
        $sql = "UPDATE orders SET status = '$status' WHERE id = '$id' " ;
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }


}