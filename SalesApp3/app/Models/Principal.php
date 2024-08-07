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

// app/Models/Principal.php

    public function distributors()
    {
        return $this->belongsToMany(Distributor::class, 'distributor_principal',  'ID_Distributor', 'ID_Principal');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'Brand', 'ID_Principal');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'Brand', 'ID_Principal');
    }
}