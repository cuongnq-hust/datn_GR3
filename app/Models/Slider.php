<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false; // set time false
    protected $fillable = [
        'slider_name', 'slider_image', 'slide_status','slide_desc'
    ];
    protected $primaryKey = 'slider_id';
    protected $table = 'tbl_slider';
    use HasFactory;

}
