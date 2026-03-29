<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'address',
    'status',
  ];

  public function users()
  {
    return $this->hasMany(User::class);
  }

  public function approved(): bool
  {
    return $this->status === 'approved';
  }
}
