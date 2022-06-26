<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public $timestamps = false; // set time false
    protected $fillable = [
        'customer_name', 'customer_email', 
        'customer_password','customer_phone','customer_vip','customer_token','customer_picture'
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customers';
    use HasFactory;
}
