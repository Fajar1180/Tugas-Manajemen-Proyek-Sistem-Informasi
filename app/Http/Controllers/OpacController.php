<?php
namespace App\Http\Controllers;
use App\Models\{Book, Category, EResource};
use Illuminate\Http\Request;
class OpacController extends Controller {
    public function index(Request $request) {
        $query = Book::with('category');
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title','like',"%{$request->search}%")
                  ->orWhere('author','like',"%{$request->search}%")
                  ->orWhere('isbn','like',"%{$request->search}%");
            });
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        $books = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();
        return view('opac.index', compact('books','categories'));
    }
    public function show(Book $book) {
        $book->load('category');
        return view('opac.show', compact('book'));
    }
}
