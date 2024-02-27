<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Likefoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_foto'
    ];
    protected $table = 'likefotos';

    // Relasi nilai balik
    public function foto(){
        return $this->belongsTo(Foto::class, 'id_foto', 'id');
    }

    // Relasi nilai balik ek dalam tabel user
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
