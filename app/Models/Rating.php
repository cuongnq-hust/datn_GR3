<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = false; // set time false
    protected $fillable = [
        'product_id', 'rating'
    ];
    protected $primaryKey = 'rating_id';
    protected $table = 'tbl_rating';
    use HasFactory;
}
