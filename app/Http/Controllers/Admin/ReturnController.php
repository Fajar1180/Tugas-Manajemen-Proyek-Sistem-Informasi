<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Loan, LoanReturn};
use Illuminate\Http\Request;
use Carbon\Carbon;
class ReturnController extends Controller {
    public function create(Loan $loan) {
        if ($loan->status === 'returned') {
            return redirect()->route('admin.loans.show', $loan)->with('error','Peminjaman ini sudah dikembalikan.');
        }
        $loan->load(['member.user','loanItems.book']);
        $due = Carbon::parse($loan->due_date)->startOfDay();
        $today = now()->startOfDay();
        $lateDays = max(0, (int) $due->diffInDays($today, false));
        $fineAmount = $lateDays * config('library.fine_per_day', 1000);
        $returnDate = now()->toDateString();
        return view('admin.returns.create', compact('loan','lateDays','fineAmount','returnDate'));
    }
    public function store(Request $request) {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'return_date' => 'required|date',
            'note' => 'nullable|string',
        ]);
        $loan = Loan::with('loanItems.book')->findOrFail($request->loan_id);
        $due = Carbon::parse($loan->due_date)->startOfDay();
        $ret = Carbon::parse($request->return_date)->startOfDay();
        $lateDays = max(0, (int) $due->diffInDays($ret, false));
        $fineAmount = $lateDays * config('library.fine_per_day', 1000);
        LoanReturn::create([
            'loan_id' => $loan->id,
            'return_date' => $request->return_date,
            'late_days' => $lateDays,
            'fine_amount' => $fineAmount,
            'note' => $request->note,
        ]);
        $loan->update(['status' => 'returned']);
        foreach ($loan->loanItems as $item) {
            $item->book->increment('stock', $item->qty);
        }
        if ($fineAmount > 0) {
            return redirect()->route('admin.loans.show', $loan)->with('success','Pengembalian berhasil. Ada denda Rp ' . number_format($fineAmount));
        }
        return redirect()->route('admin.loans.index')->with('success','Pengembalian berhasil tanpa denda.');
    }
}
