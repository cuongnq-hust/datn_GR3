<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'meta_keywords', 'category_name', 'category_slug','category_desc','category_status','category_parent','category_order'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
    use HasFactory;
}
