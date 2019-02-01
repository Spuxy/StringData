<?php

class BookPresenter extends Presenter
{

    public function process($params)
    {

        $bookModel = new BookModel();
        if ($params[1] == 'odstranit') {
           $bookModel->deleteBook($params[0]);
            $this->redirect('book');
        }


		if (!empty($params[0]))
		{

            $book = $bookModel->getBook($params[0]);

			if (!$book)
				$this->redirect('error');

            $this->data['writer'] = $book['writer'];
			$this->data['title'] = $book['title'];
            $this->data['ean'] = $book['EAN'];
			$this->data['description'] = $book['description'];
			$this->data['countbook']= $book['countbook'];

			$this->template = 'book';
		}
		else
		{
			$books = $bookModel->getBooks();
			$this->data['books'] = $books;
			$this->template = 'books';
		}

    }
}