<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialCustomers extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'provider_user_id',  'provider',  'user','provider_user_email'
    ];
 
    protected $primaryKey = 'user_id';
 	protected $table = 'tbl_social_customers';
 	public function customers(){
 		return $this->belongsTo('App\Models\Customers', 'user');
 	}

    use HasFactory;
}
