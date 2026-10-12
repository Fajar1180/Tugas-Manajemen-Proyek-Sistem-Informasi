<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LoanReturn extends Model {
    protected $table = 'returns';
    protected $fillable = ['loan_id','return_date','late_days','fine_amount','note'];
    protected $casts = ['return_date' => 'date'];
    public function loan() { return $this->belongsTo(Loan::class); }
    public function finePayments() { return $this->hasMany(FinePayment::class, 'return_id'); }
    public function getIsLateAttribute() { return $this->late_days > 0; }
    public function getTotalPaidAttribute() { return $this->finePayments->sum('amount'); }
    public function getRemainingFineAttribute() { return max(0, $this->fine_amount - $this->total_paid); }
}
