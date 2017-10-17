<?php

namespace Models;


class Authors extends Models
{
    public static $table = 'authors';
    public $id;
    public $name;

    public static function findBooktoAuthor($id)
    {
        $db = DB::getInstance();
        /**
         * SELECT books.id , books.title, books.price, books.description, books.img
        FROM book_to_author
        JOIN books ON books.id = book_to_author.id_book
        JOIN genre ON genre.id = book_to_author.id_author
        WHERE genre.id = :id AND books.active = "yes"
         */
        $data = $db->query(
            'select b.id, b.title, b.price, b.description, b.discount, b.img, a.id as a_id, a.name as a_name , g.id as g_id, g.name as
             g_name from books b
             inner join book_to_author ba on b.id = ba.id_book
             inner join authors a on ba.id_author = a.id
             inner join book_to_genre bg on b.id = bg.id_book
             inner join genre g on bg.id_genre = g.id AND active = "yes"
             WHERE a.id = :id',
            [':id' => $id]
        );
        return $data;
    }
}