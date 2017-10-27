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

    public function addBookToAuthor($id_book, $id_author)
   {

        $sql = "INSERT INTO book_to_author (id_book, id_author)
             VALUES ('$id_book', '$id_author')";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

    public function dellBookToAuthor($id_book)
    {
        $sql = "DELETE FROM `book_to_author` WHERE id_book = '$id_book'";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }



    public static function testAuthor()
    {
        return true;
    }

}