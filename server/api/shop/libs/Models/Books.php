<?php

namespace Models;


class Books extends Models
{
    public static $table = 'books';
    public $id;
    public $title;
    public $price;
    public $description;
    public $discount;
    public $active;
    public $img;


    public static function findAllBooks()
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT b.id, b.title, b.price, b.description, b.discount, b.img, a.id AS a_id, a.name AS a_name , g.id AS g_id, g.name AS g_name
             FROM books b
             INNER JOIN book_to_author ba ON b.id = ba.id_book
             INNER JOIN authors a ON ba.id_author = a.id
             INNER JOIN book_to_genre bg ON b.id = bg.id_book
             INNER JOIN genre g ON bg.id_genre = g.id
             AND active = "yes"
             ORDER BY b.id ',
            []
        );
        return $data;
    }

    public static function findByidBooks($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT b.id, b.title, b.price, b.description, b.discount, b.img, a.id AS a_id, a.name AS a_name , g.id AS g_id, g.name AS g_name
             FROM books b
             INNER JOIN book_to_author ba ON b.id = ba.id_book
             INNER JOIN authors a ON ba.id_author = a.id
             INNER JOIN book_to_genre bg ON b.id = bg.id_book
             INNER JOIN genre g ON bg.id_genre = g.id
             AND active = "yes"
             WHERE b.id = :id
              ',
            [':id' => $id]
        );
        return $data;
    }

    public function findBookAdmin()
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT b.id, b.title, b.price, b.description, b.discount, b.img, a.id AS a_id, a.name AS a_name , g.id AS g_id, g.name AS g_name
             FROM books b
             INNER JOIN book_to_author ba ON b.id = ba.id_book
             INNER JOIN authors a ON ba.id_author = a.id
             INNER JOIN book_to_genre bg ON b.id = bg.id_book
             INNER JOIN genre g ON bg.id_genre = g.id
             ORDER BY b.id ',
            []
        );
        return $data;
    }

    public function addBook($title, $price, $description, $discount, $active)
    {
        $sql = "INSERT INTO books (title, price, description, discount, active)
             VALUES ('$title', '$price', '$description', '$discount', '$active')";
        $db = DB::getInstance();
        $db->execute($sql);
        $result['id_book'] = $db->lastInsertId();
        return $result;
    }
    public static function findByidBooksAdmin($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'SELECT b.id, b.title, b.price, b.description, b.discount, b.img, b.active, a.id AS a_id, a.name AS a_name , g.id AS g_id, g.name AS g_name
             FROM books b
             INNER JOIN book_to_author ba ON b.id = ba.id_book
             INNER JOIN authors a ON ba.id_author = a.id
             INNER JOIN book_to_genre bg ON b.id = bg.id_book
             INNER JOIN genre g ON bg.id_genre = g.id
             WHERE b.id = :id
              ',
            [':id' => $id]
        );
        return $data;
    }

    public function updateBook($title,$price,$description,$discount,$active,$id)
    {
        $sql = "UPDATE  " . static::$table ." SET title= '$title', price= '$price', description = '$description',
           discount = '$discount', active = '$active'  WHERE id='$id' ";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }
}