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
            'select b.id, b.title, b.price, b.description, b.discount, b.img, a.id as a_id, a.name as a_name , g.id as g_id, g.name as
             g_name from books b
             inner join book_to_author ba on b.id = ba.id_book
             inner join authors a on ba.id_author = a.id
             inner join book_to_genre bg on b.id = bg.id_book
             inner join genre g on bg.id_genre = g.id AND active = "yes"
             ORDER BY b.id ',
            []
        );
        return $data;
    }

    public static function findByidBooks($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'select b.id, b.title, b.price, b.description, b.discount, b.img, a.id as a_id, a.name as a_name , g.id as g_id, g.name as
             g_name from books b
             inner join book_to_author ba on b.id = ba.id_book
             inner join authors a on ba.id_author = a.id
             inner join book_to_genre bg on b.id = bg.id_book
             inner join genre g on bg.id_genre = g.id  AND active = "yes" WHERE b.id = :id
              ',
            [':id' => $id]
        );
        return $data;
    }
}