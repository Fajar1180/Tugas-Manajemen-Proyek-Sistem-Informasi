<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class EResource extends Model {
    protected $table = 'eresources';
    protected $fillable = ['title','type','file_path','url','description','uploaded_by'];
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
