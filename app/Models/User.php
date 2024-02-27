<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Foto;
use App\Models\Follow;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Likefoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'no_telepon',
        'jenis_kelamin',
        'alamat',
        'bio',
        'status_user',
        'pictures',
        'email',
        'password',
        'tgl_lahir'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi Kedalam tabel Foto
    public function fotos(){
        return $this->hasMany(Foto::class, 'id_user', 'id');
    }

    // Relasi ke likefoto
    public function likefotos(){
        return $this->hasMany(Likefoto::class, 'id_user', 'id');
    }

    // Relasi ke comments
    public function comments(){
        return $this->hasMany(Comment::class, 'id_user', 'id');
    }

    // Relasi ke dalam tabel user
    public function follows(){
        return $this->hasMany(Follow::class, 'id_user', 'id');
    }

    // Relasi ke dalam tabel favorite
    public function favorites(){
        return $this->hasMany(Favorite::class, 'id_user', 'id');
    }

}
