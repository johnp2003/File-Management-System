<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FileController extends Controller
{
    public function getData($folderId){
        $files = DB::table('files')->where('folder_id', $folderId)->orderBy('id','desc')->get();
        return $files;
    }

    public function upload($id, Request $request){
        $request->validate([
            'file' => 'required|mimes:png,jpg,pdf,html|max:2048'
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');

        DB::table('files')->insert([
            'name' => $file->getClientOriginalName(),
            'name_generate' => $filename,
            'type' => $file->guessExtension(),
            'size' => $file->getSize(),
            'folder_id' => $id
        ]);
    }

    public function download($id){
        $file = DB::table('files')->where('id',$id)->first();
        $path = storage_path('app/public/uploads/'. $file->name_generate);
        return response()->download($path);
    }

    public function delete($id){
        $file = DB::table('files')->where('id',$id)->first();
        unlink(storage_path('app/public/uploads/'. $file->name_generate));

        $result = DB::table('files')->where('id',$id)->delete();
        return $result;
    }
  
    public function search(Request $request){
        $keyword = '%' . $request->keyword . '%';
        $files = DB::table('files')->where('name', 'like', $keyword)->get();
        return $files;
    }
    
}
