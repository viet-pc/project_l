<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    public function myFiles()
    {
        return Inertia::render('MyFiles');
    }

    public function createFolder(StoreFolderRequest $request){
        $data = $request->validate();
        $parent = $request->parent;
    }
}
