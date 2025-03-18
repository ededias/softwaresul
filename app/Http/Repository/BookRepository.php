<?php
namespace App\Http\Repository;

use App\Models\Book;
use App\Http\Repository\BookInterface;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class BookRepository implements BookInterface {
	
	public function all(?string $search) {
		// Implementation for retrieving all books
        try {
            $book = Book::query();
           
            if ($search) {
                $book->where('author', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%")
                ->orWhere('genre', 'like', "%{$search}%")
                ->orWhere('isbn', 'like', "%{$search}%");
            } 
            
            return $book->with(['booking'])->get();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
	}

	public function create(array $data) {
		// Implementation for creating a new book
        try {
            return Book::create($data);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
	}

	public function delete($id) {
		// Implementation for deleting a book by id
        try {
            return Book::destroy($id);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
	}

	public function show($id) {
		// Implementation for showing a book by id
        try {
            $book = Book::find($id);
           
            return $book;
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }

	}

	public function update(array $data, $id) {
		// Implementation for updating a book by id
        try {
            return Book::where('id', $id)->update($data);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
	}


    public function  createBooking(int $id, int $userId) {
        // Implementation for creating a booking
        try {
           

            $booking = Booking::create([
                'user_id' => $userId,
                'book_id' => $id
            ]);
            $books = Book::find($id);
            $books->quantity = $books->quantity - 1;
            $books->save();
            return $booking;

        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }

    public function deleteBooking(int $id, int $userId) {
        // Implementation for deleting a booking
        try {
            $booking = Booking::where('book_id', $id)->where('user_id', $userId)->delete();
            $books = Book::find($id);
            $books->quantity = $books->quantity + 1;
            $books->save();
            return $booking;
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }


}