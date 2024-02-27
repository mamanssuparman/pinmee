<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_follow'
    ];
    protected $table = 'follows';

    // Relasi nilai balik ke dalam tabel user
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
