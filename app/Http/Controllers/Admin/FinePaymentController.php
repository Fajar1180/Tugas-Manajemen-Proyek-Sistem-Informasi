<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{LoanReturn, FinePayment};
use Illuminate\Http\Request;
class FinePaymentController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'return_id' => 'required|exists:returns,id',
            'pay_date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|in:cash,transfer',
            'note' => 'nullable|string',
        ]);
        FinePayment::create($request->only('return_id','pay_date','amount','method','note'));
        $loanReturn = LoanReturn::with('loan')->findOrFail($request->return_id);
        return redirect()->route('admin.loans.show', $loanReturn->loan)->with('success','Pembayaran denda berhasil dicatat.');
    }
}
