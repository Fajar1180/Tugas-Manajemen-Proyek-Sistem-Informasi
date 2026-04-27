<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class DashboardController extends Controller {
    public function index() {
        $member = auth()->user()->member;
        if (!$member) {
            return view('member.dashboard', ['member' => null, 'loans' => collect(), 'stats' => []]);
        }
        $loans = $member->loans()->with('loanItems.book')->latest()->get();
        $stats = [
            'total_loans' => $loans->count(),
            'active_loans' => $loans->where('status','borrowed')->count(),
            'returned_loans' => $loans->where('status','returned')->count(),
            'overdue_loans' => $loans->filter(fn($l) => $l->is_overdue)->count(),
        ];
        return view('member.dashboard', compact('member','loans','stats'));
    }
}
