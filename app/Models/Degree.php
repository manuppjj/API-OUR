<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class Degree extends Model
{
  use HasApiTokens, HasFactory, Notifiable;


  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */

  protected $fillable = ['nombre', 'jornada', 'numeroAlumnos',];
  protected $allowIncluded = ['alumnos', 'asignatura', 'chat'];
  protected $allowFilter = ['id', 'nombre', 'jornada', 'numeroAlumnos'];
  protected $allowSort = ['id', 'nombre', 'jornada', 'numeroAlumnos'];


  public function scopeIncluded(Builder $query)
  {

    // if(empty($this->allowIncluded)||empty(request('included'))){
    //     return;
    // }

    $relations = explode(',', request('included')); //['posts','relation2']

    $allowIncluded = collect($this->allowIncluded); //colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']

    foreach ($relations as $key => $relationship) { //recorremos el array de relaciones

      if (!$allowIncluded->contains($relationship)) {
        unset($relations[$key]);
      }
    }
    $query->with($relations); //se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included

  }

  ////////////////////////////////////////////////////////

  public function scopeFilter(Builder $query)
  {


    if (empty($this->allowFilter) || empty(request('filter'))) {
      return;
    }

    $filters = request('filter');
    $allowFilter = collect($this->allowFilter);

    foreach ($filters as $filter => $value) {

      if ($allowFilter->contains($filter)) {
        $query->where($filter, 'LIKE', '%' . $value . '%');
      }
    }
    //http://localhost/laravel/public/v1/degrees?filter[numeroAlumnos]=8

  }




  //////////////////////////////////////////////////////////////////////////////////



  public function scopeSort(Builder $query)
  {


    if (empty($this->allowSort) || empty(request('sort'))) {
      return;
    }


    $sortFields = explode(',', request('sort'));
    $allowSort = collect($this->allowSort);

    foreach ($sortFields as $sortField) {

      if ($allowSort->contains($sortField)) {

        $query->orderBy($sortField, 'asc');
      }
    }
  }


  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];






  public function maestros()
  {
    return $this->belongsToMany('App\Models\Maestro');
  }


  public function asignatura()
  {
    return $this->hasMany('App\Models\Asignatura');
  }


  public function alumnos()
  {
    return $this->hasMany('App\Models\Alumno');
  }

  public function chat()
  {
    return $this->hasOne('App\Models\Chat');
  }
}
