<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; // set time false
    protected $fillable = [
        'product_name', 'brand_id', 'category_id', 'product_desc', 'product_content', 'product_price',
        'product_image', 'product_status', 'product_slug', 'product_tags','product_views','product_cost'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    use HasFactory;
}
