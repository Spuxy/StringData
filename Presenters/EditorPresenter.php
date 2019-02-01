<?php

class EditorPresenter extends Presenter
{
    public function process($parametry)
    {

        $bookModel = new BookModel();

        $book = array(
            'book_id' => '',
            'title' => '',
            'writer'=> '',
            'EAN' => '',
            'countbook' => '',
            'description'=>''

        );

        if ($_POST)
        {
            $keys = array('book_id', 'title','writer', 'EAN','countbook', 'description' );
            $book = array_intersect_key($_POST, array_flip($keys));
            $bookModel->saveBook($_POST['book_id'], $book);
            $this->redirect('book/'.$book['ean']);
        }
        else if (!empty($parametry[0]))
        {
            $getBook = $bookModel->getBook($parametry[0]);
            if ($getBook)
                $book = $getBook;
        }
        $this->data['book'] = $book;
        $this->template = 'editor';
    }
}