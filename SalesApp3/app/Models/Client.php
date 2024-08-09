<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'ID_Client';

    protected $fillable = [
        'Client_Name',
        'NameUser',
        'Client_Address',
        'Client_TaxID',
        'Category',
        'Bandwidth',
        'TotalEndpoint',
        'DataCenterModel',
        'ConcurrentUser',
        'InternalNotes'
    ];    

    public static $categories = ['Financial Service Industry', 'Government', 'Hospital', 'Education', 'Hotel', 'Military', 'Private'];

    public function pics()
    {
        return $this->hasMany(ClientPIC::class, 'Client_Name', 'ID_Client');
    }

    public function salesname()
    {
        return $this->hasMany(Sale::class, 'Client_Name', 'ID_Client');
    }

    public function salespic()
    {
        return $this->hasMany(Sale::class, 'ClientPIC_Name', 'ID_Client');
    }

    public function salesstaff()
    {
        return $this->hasMany(Sale::class, 'NameUser', 'ID_Client');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'NameUser', 'ID_User');
    }
}
