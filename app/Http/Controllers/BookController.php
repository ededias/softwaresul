<?php

namespace App\Http\Controllers;

use App\Http\Services\BookService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{

    public function __construct(
        private BookService $bookService
    ) {}

    //
    public function addBook() 
    {
        return inertia::render('EditBook');
    }

    public function newBook(Request $request) 
    {
        try {
            $this->bookService->create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function editBook($id)
    {
        $book = $this->bookService->show($id);
       
        return inertia::render('EditBook', ['book' => $book]);
    }

    public function updateBook(Request $request, $id)
    {
        try {
            $this->bookService->update($request->all(), $id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteBook($id)
    {
        try {
            $this->bookService->delete($id);
            $books = $this->bookService->all();
            return response()->json(['message' => 'Livro deletado com sucesso', 'books' => $books]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function createBooking($id)
    {
        try {
            $booking = $this->bookService->createBooking($id);
            $books = $this->bookService->all();
            return response()->json(['message' => 'Livro reservado com sucesso', 'books' => $books, 'booking' => $booking]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    } 

    public function deleteBooking($id)
    {
        try {
            $this->bookService->deleteBooking($id);
            $books = $this->bookService->all();
            return response()->json(['message' => 'Livro reservado com sucesso', 'books' => $books]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function searchBook(Request $request)
    {
        try {
            $books = $this->bookService->all($request->search);
            return $books;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
