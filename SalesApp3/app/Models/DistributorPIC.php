<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorPIC extends Model
{
    use HasFactory;

    protected $table = 'distributorpics';
    protected $primaryKey = 'Distributor_PIC_ID';
    public $timestamps = false;

    protected $fillable = [
        'Distributor_Name',
        'DistPIC_Name',
        'DistPIC_JobPosition',
        'DistPIC_Phone',
        'DistPIC_Email'
    ];

    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'Distributor_Name', 'ID_Distributor');
    }
}