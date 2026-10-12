<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Loan, LoanItem, Member, Book};
use Illuminate\Http\Request;
class LoanController extends Controller {
    public function index(Request $request) {
        $query = Loan::with(['member.user','loanItems.book']);
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $loans = $query->latest()->paginate(10)->withQueryString();
        return view('admin.loans.index', compact('loans'));
    }
    public function create() {
        $members = Member::with('user')->get();
        $books = Book::where('stock','>',0)->get();
        return view('admin.loans.create', compact('members','books'));
    }
    public function store(Request $request) {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id',
            'note' => 'nullable|string',
        ]);
        $loanDate = now()->toDateString();
        $dueDate = now()->addDays(config('library.loan_days', 7))->toDateString();
        $loan = Loan::create([
            'member_id' => $request->member_id,
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'status' => 'borrowed',
            'note' => $request->note,
        ]);
        foreach ($request->book_ids as $bookId) {
            LoanItem::create(['loan_id' => $loan->id, 'book_id' => $bookId, 'qty' => 1]);
            Book::find($bookId)->decrement('stock');
        }
        return redirect()->route('admin.loans.index')->with('success','Peminjaman berhasil dibuat.');
    }
    public function show(Loan $loan) {
        $loan->load(['member.user','loanItems.book','loanReturn.finePayments']);
        return view('admin.loans.show', compact('loan'));
    }
}
