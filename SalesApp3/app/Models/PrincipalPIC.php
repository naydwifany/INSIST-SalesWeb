<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalPIC extends Model
{
    use HasFactory;

    protected $primaryKey = 'Principal_PIC_ID';

    protected $fillable = [
        'Brand',
        'PrincipalName',
        'PrincipalJobPosition',
        'PrincipalPhone',
        'PrincipalEmail',
    ];

    protected $table = 'principalpics';

    public function principal()
    {
        return $this->belongsTo(Principal::class, 'Brand', 'ID_Principal');
    }
}