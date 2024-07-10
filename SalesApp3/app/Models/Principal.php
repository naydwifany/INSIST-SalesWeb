<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

    protected $table = 'principals';

    protected $primaryKey = 'ID_Principal';

    protected $fillable = [
        'Brand',
        'PrincipalAddress',
    ];

    public function pics()
    {
        return $this->hasMany(PrincipalPIC::class, 'Brand', 'ID_Principal');
    }
}