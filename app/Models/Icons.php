<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icons extends Model
{
    public $timestamps = false; // set time false
    protected $fillable = [
        'name', 'image', 'link'
    ];
    protected $primaryKey = 'id_icons';
    protected $table = 'tbl_icons';
    use HasFactory;
}
