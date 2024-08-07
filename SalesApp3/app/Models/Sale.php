<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'Sales_Date',
        'Client_Name',
        'ClientPIC_Name',
        'NameUser',
        'Brand',
        'Distributor_Name',
        'Product_Name',
        'Category',
        'Quantity',
        'UnitPrice',
        'TotalPrice',
        'SerialNumber',
        'ExpDate',
        'ContractNumber',
        'SalesNotes',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'Client_Name');
    }

    public function clientPic()
    {
        return $this->belongsTo(ClientPIC::class, 'ClientPIC_Name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'NameUser', 'ID_User');
    }

    public function brand()
    {
        return $this->belongsTo(Principal::class, 'Brand');
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'Distributor_Name');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_Name');
    }

    public function category()
    {
        return $this->belongsTo(Product::class, 'Category');
    }
}