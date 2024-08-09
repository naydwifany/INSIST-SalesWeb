<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'ID_Product';

    protected $fillable = [
        'Product_Name',
        'Brand',
        'Product_Type',
        'Product_Spec',
        'Category',
    ];

    public static $categories = ['Hardware', 'License', 'Guarantee', 'Service', 'Training'];

    public function principal()
    {
        return $this->belongsTo(Principal::class, 'Brand', 'ID_Principal');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'Product_Name', 'ID_Product');
    }

    public function salesCategory()
    {
        return $this->hasMany(Sale::class, 'Category', 'ID_Product');
    }
}
