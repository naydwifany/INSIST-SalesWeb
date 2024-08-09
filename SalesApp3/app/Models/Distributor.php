<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Distributor';

    protected $fillable = [
        'Distributor_Name',
        'TaxID_Distributor',
    ];

    public function brands()
    {
        return $this->belongsToMany(Principal::class, 'distributor_principal', 'ID_Distributor', 'ID_Principal');
    }
    public function pics()
    {
        return $this->hasMany(DistributorPIC::class, 'Distributor_Name', 'ID_Distributor');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'Distributor_Name', 'ID_Distributor');
    }
}