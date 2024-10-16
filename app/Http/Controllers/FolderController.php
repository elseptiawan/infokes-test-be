<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;


class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::whereNull('parent_id')->with(['subfolders', 'files'])->get();
        return response()->json([
            'success' => true,
            'message' => 'Folders retrieved successfully',
            'data' => $folders
        ]);
    }

    public function show(Folder $folder)
    {
        $subfolders = $folder->load(['subfolders', 'files']);
        return response()->json([
            'success' => true,
            'message' => 'Folders retrieved successfully',
            'data' => $subfolders
        ]);
    }
}
