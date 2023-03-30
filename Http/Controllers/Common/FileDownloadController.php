<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'path' => "required"
        ]);
        return Storage::download($request->path);
    }

}
