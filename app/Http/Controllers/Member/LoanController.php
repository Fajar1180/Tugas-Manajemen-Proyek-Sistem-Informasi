<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
class LoanController extends Controller {
    public function index() {
        $member = auth()->user()->member;
        if (!$member) {
            return view('member.loans.index', ['loans' => collect()]);
        }
        $loans = $member->loans()->with(['loanItems.book','loanReturn'])->latest()->paginate(10);
        return view('member.loans.index', compact('loans'));
    }
    public function show(Loan $loan) {
        $member = auth()->user()->member;
        if (!$member || $loan->member_id !== $member->id) {
            abort(403);
        }
        $loan->load(['loanItems.book','loanReturn.finePayments']);
        return view('member.loans.show', compact('loan'));
    }
}
