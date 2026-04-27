<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FinePayment extends Model {
    protected $fillable = ['return_id','pay_date','amount','method','note'];
    protected $casts = ['pay_date' => 'date'];
    public function loanReturn() { return $this->belongsTo(LoanReturn::class, 'return_id'); }
}
