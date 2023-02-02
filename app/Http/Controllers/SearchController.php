<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request){
        $search = $request->search;
        $keysearch =  DB::table('tasks')->where('title','like',"%" . $search  . "%")->get();    
        return view('backend.search',['keysearch'=>$keysearch,'search'=>$search]);
    }
}
