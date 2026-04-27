<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Book, Category};
use Illuminate\Http\Request;
class BookController extends Controller {
    public function index(Request $request) {
        $query = Book::with('category');
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title','like',"%{$request->search}%")
                  ->orWhere('author','like',"%{$request->search}%")
                  ->orWhere('isbn','like',"%{$request->search}%");
            });
        }
        $books = $query->latest()->paginate(10)->withQueryString();
        return view('admin.books.index', compact('books'));
    }
    public function create() {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'isbn' => 'nullable|string|unique:books',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'category_id' => 'nullable|exists:categories,id',
            'shelf_location' => 'nullable|string|max:50',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers','public');
        }
        Book::create($data);
        return redirect()->route('admin.books.index')->with('success','Buku berhasil ditambahkan.');
    }
    public function show(Book $book) {
        $book->load('category','loanItems.loan.member.user');
        return view('admin.books.show', compact('book'));
    }
    public function edit(Book $book) {
        $categories = Category::all();
        return view('admin.books.edit', compact('book','categories'));
    }
    public function update(Request $request, Book $book) {
        $data = $request->validate([
            'isbn' => 'nullable|string|unique:books,isbn,'.$book->id,
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'category_id' => 'nullable|exists:categories,id',
            'shelf_location' => 'nullable|string|max:50',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers','public');
        }
        $book->update($data);
        return redirect()->route('admin.books.index')->with('success','Buku berhasil diperbarui.');
    }
    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success','Buku berhasil dihapus.');
    }
}
