<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seleksi extends Model
{
  protected $table = 'seleksi';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'peminatan', 'berkas', 'status'
  ];

  /**
   * Get the phone record associated with the user.
   */
  public function user()
  {
    return $this->hasOne('App\User', 'id', 'id');
  }
}
