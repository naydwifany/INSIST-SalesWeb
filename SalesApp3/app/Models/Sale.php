<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $primaryKey = 'ID_Sales';

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
        return $this->belongsTo(Client::class, 'Client_Name', 'ID_Client');
    }

    public function clientPic()
    {
        return $this->belongsTo(ClientPIC::class, 'ClientPIC_Name', 'Client_PIC_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'NameUser', 'ID_User');
    }

    public function brand()
    {
        return $this->belongsTo(Principal::class, 'Brand', 'ID_Principal');
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'Distributor_Name', 'ID_Distributor');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_Name', 'ID_Product');
    }

    public function category()
    {
        return $this->belongsTo(Product::class, 'Category', 'ID_Product');
    }
}