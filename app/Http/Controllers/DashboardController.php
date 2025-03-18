<?php

namespace App\Http\Controllers;

use App\Http\Services\BookService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    
    public function __construct(
        private BookService $bookService
    ){}

    public function index(Request $request) 
    {

        $data = $request->all();
        
        $books = $this->bookService->all($request->search);

        return Inertia::render('Dashboard', [
            'books' => $books
        ]);
    }

}
