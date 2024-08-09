<?php

// app/Models/PrincipalPIC.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalPIC extends Model
{
    use HasFactory;

    protected $table = 'principalpics';
    protected $primaryKey = 'Principal_PIC_ID';
    public $timestamps = false;

    protected $fillable = [
        'Brand',
        'PrincipalName',
        'PrincipalJobPosition',
        'PrincipalPhone',
        'PrincipalEmail',
        'Notes'
    ];

    public function principal()
    {
        return $this->belongsTo(Principal::class, 'Brand', 'Brand');
    }
}