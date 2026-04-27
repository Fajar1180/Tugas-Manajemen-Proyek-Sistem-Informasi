<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Member extends Model {
    protected $fillable = ['user_id', 'nim_nidn', 'prodi', 'no_hp', 'alamat'];
    public function user() { return $this->belongsTo(User::class); }
    public function loans() { return $this->hasMany(Loan::class); }
}
