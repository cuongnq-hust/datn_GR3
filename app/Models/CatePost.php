<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatePost extends Model
{
    protected $fillable = [
        'cate_post_name', 'cate_post_slug', 'cate_post desc','cate_post_status'
    ];
    protected $primaryKey = 'cate_post_id';
    protected $table = 'tbl_category_post';
    
    public function post(){
        return $this->hasMany('App\Models\Post');
    }
    use HasFactory;
}
