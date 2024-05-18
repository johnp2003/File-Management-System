<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FolderController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $folder = DB::table('folders')->insert($request->all());

        return $folder;
    }

    public function edit($id){
        $folder = DB::table('folders')->where('id',$id)->first();

        return $folder;
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required'
        ]);

        $folder = DB::table('folders')->where('id',$id)->update($request->all());

        return $folder;
    }

    public function delete($id){
        $folder = DB::table('folders')->where('id',$id)->delete();
        

        return $folder;
    }
}
