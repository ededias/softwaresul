<?php

namespace App\Http\Services;

use App\Http\Repository\BookInterface;
use Illuminate\Support\Facades\Log;

class BookService 
{
    

    public function __construct(
        private BookInterface $bookRepository 
    ) {}

    public function all($payload = '') {
        try {
            return $this->bookRepository->all($payload);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
            
        }
    }

    public function create(array $data) {
        try {
            return $this->bookRepository->create($data);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }

    public function delete($id) {
        try {
            return $this->bookRepository->delete($id);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }

    public function show($id) {
        try {
            return $this->bookRepository->show($id);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }

    public function update(array $data, $id) {
        try {
            $this->bookRepository->update($data, $id);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }
    

    public function createBooking($id) 
    {
        try {
            return $this->bookRepository->createBooking($id, auth()->user()->id);  
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }

    public function deleteBooking($id) 
    {
        try {
            return $this->bookRepository->deleteBooking($id, auth()->user()->id);  
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }

}