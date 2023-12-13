<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo('App\Models\User');
      }

      public function degree() {
        return $this->belongsTo('App\Models\Degree');
      }

      public function padre() {
        return $this->belongsTo('App\Models\Padre');
      }
}
