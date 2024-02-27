<?php

namespace App\Models;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_foto',
        'isi_komentar'
    ];
    protected $table = 'comments';

    // Relasi nilai balik ke user
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');;
    }

    // Relasi nilai balik ke dalam tabel Fotos
    public function foto(){
        return $this->belongsTo(Foto::class, 'id_foto', 'id');
    }
}
