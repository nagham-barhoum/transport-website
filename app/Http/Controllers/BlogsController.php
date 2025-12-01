<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogsController extends Controller
{
    public function  index($type)
    {
        $blogFile = File::get(storage_path('app/blog.json'));
        $blogsObject = json_decode($blogFile); // Object
        foreach($blogsObject->blogs as $blogObject){
            if($blogObject->route === $type){
                $blog = $blogObject;
                break;
            }
        }
        return view('blogs.blog', compact('blog'));
    }
}
