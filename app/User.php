<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim', 'name', 'email', 'password', 'username', 'photo', 'tgl_lahir', 'jurusan', 'fakultas', 'angkatan', 'alamat', 'about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function seleksi()
    {
      return $this->belongsTo('App\Seleksi', 'id', 'id');
    }
}
