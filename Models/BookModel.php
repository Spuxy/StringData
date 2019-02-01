<?php

class BookModel extends Db
{

	public function getBook($ean)
	{
		return Db::getOne('
			SELECT `book_id`, `title`, `writer`, `EAN`, `countbook`,`description`
			FROM `books` 
			WHERE `EAN` = ?
		', array($ean));
	}

    public function newBook($ean)
    {
        return Db::getOne('
			INSERT INTO `books` (`book_id`, `title`, `writer`, `EAN`, `countbook`) VALUE (?,?,?,?,?)	
		', array($ean));
    }

	public function getBooks()
	{
		return Db::getAll('
			SELECT `book_id`, `title`, `EAN`, `description`, `countbook`
			FROM `books` 
			ORDER BY `book_id` DESC
		');
	}

	public function deleteBook($ean)
    {
        return Db::ask('
			DELETE
			FROM `books` 
			WHERE `EAN` = ?
		', array($ean));
    }

    public function saveBook($id, $book)
    {
        if (!$id)
            Db::insert('books', $book);
        else
            Db::change('books', $book, 'WHERE book_id = ?', array($id));
    }

}