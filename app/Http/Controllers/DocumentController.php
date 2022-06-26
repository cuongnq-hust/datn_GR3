<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Backtrace\File;
use App\Models\Document;

class DocumentController extends Controller
{
    //
    public function create_folder(){
        Storage::cloud()->put('test.txt','Tom riddle');
        dd('created');
    }
}
