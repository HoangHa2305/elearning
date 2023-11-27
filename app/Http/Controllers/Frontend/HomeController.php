<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function setSemester(string $id)
    {
        
    }

    public function dowloadTopic(string $name)
    {
        $path = storage_path('app/public/documents/'.$name);

        return response()->download($path);
    }
}
