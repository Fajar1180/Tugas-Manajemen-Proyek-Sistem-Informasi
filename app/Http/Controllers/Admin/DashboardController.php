<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Book, Member, Loan, EResource};
class DashboardController extends Controller {
    public function index() {
        $stats = [
            'total_books' => Book::count(),
            'total_stock' => Book::sum('stock'),
            'total_members' => Member::count(),
            'active_loans' => Loan::where('status','borrowed')->count(),
            'overdue_loans' => Loan::where('status','borrowed')->where('due_date','<',now())->count(),
        ];
        $popularBooks = Book::withCount('loanItems')->orderByDesc('loan_items_count')->take(5)->get();
        $recentLoans = Loan::with(['member.user','loanItems.book'])->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats','popularBooks','recentLoans'));
    }
}
