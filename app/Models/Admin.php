<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends  Authenticatable 
{
    use  HasFactory;
    
    protected $table = 'admin';

    protected $fillable = [
        'nombre',
        'correo',
        'contrasena',
    ];
 //   public function getAuthPassword()
//{
  //  return $this->password;
//}

}
