<?php

namespace Models;


class Genre extends Models
{
    public static $table = 'genre';
    public $id_genre;
    public $id_book;

    public static function findBooktoGenre($id)
    {
        $db = DB::getInstance();
        $data = $db->query(
            'select b.id, b.title, b.price, b.description, b.discount, b.img, a.id as a_id, a.name as a_name , g.id as g_id, g.name as
             g_name from books b
             inner join book_to_author ba on b.id = ba.id_book
             inner join authors a on ba.id_author = a.id
             inner join book_to_genre bg on b.id = bg.id_book
             inner join genre g on bg.id_genre = g.id AND active = "yes"
             WHERE g.id = :id',
            [':id' => $id]
        );
        return $data;
    }

    public function addBookToGenre($id_book, $id_genre)
    {

        $sql = "INSERT INTO book_to_genre (id_book, id_genre)
             VALUES ('$id_book', '$id_genre')";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

    public function dellBookToGenre($id_book)
    {
        $sql = "DELETE FROM `book_to_genre` WHERE id_book = '$id_book'";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }
}