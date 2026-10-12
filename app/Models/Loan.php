<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Loan extends Model {
    protected $fillable = ['member_id','loan_date','due_date','status','note'];
    protected $casts = ['loan_date' => 'date', 'due_date' => 'date'];
    public function member() { return $this->belongsTo(Member::class); }
    public function loanItems() { return $this->hasMany(LoanItem::class); }
    public function loanReturn() { return $this->hasOne(LoanReturn::class); }
    public function getIsOverdueAttribute() {
        return $this->status === 'borrowed' && $this->due_date->isPast();
    }
}
