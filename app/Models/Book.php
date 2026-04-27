<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Book extends Model {
    protected $fillable = ['isbn','title','author','publisher','year','category_id','shelf_location','stock','description','cover_image'];
    public function category() { return $this->belongsTo(Category::class); }
    public function loanItems() { return $this->hasMany(LoanItem::class); }
    public function getIsAvailableAttribute() { return $this->stock > 0; }
}
