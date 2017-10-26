<?php

namespace Models;


class HistoryBook extends Models
{
    public static $table = 'history_book';
    public $title;
    public $genre;
    public $author;
    public $price;

    public function addBooktoHistory($title,$genre,$author,$price)
    {
        $sql = "INSERT INTO history_book (title, genre, author, price)
             VALUES ('$title', '$genre', '$author', '$price')";
        $db = DB::getInstance();
        $result = $db->execute($sql);
        return $result;
    }

}