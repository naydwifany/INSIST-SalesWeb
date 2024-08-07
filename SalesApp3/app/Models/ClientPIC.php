<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPIC extends Model
{
    use HasFactory;

    protected $table = 'clientpics';
    protected $primaryKey = 'Client_PIC_ID';
    public $timestamps = false;

    protected $fillable = [
        'Client_Name',
        'ClientPIC_Name',
        'ClientPIC_JobPosition',
        'ClientPIC_Phone',
        'ClientPIC_Email'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'Client_Name', 'ID_Client');
    }
}
