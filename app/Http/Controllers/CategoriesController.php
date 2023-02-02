<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{
    public function read(){
        $categories = DB::table("categories")->get();
        return View::make("backend.Categories.CategoriesRead", ["categories" => $categories]);
    }
    public function update($id){
        $categories = DB::table("categories")->where("id", "=", $id)->first();
        return View::make("backend.Categories.CategoriesUpdate",["categories"=>$categories]);
    }
    public function updatePost($id){
        $name = request("name");
        DB::table("categories")->where("id","=",$id)->update(["name" => $name]);
        return redirect(url("admin/categories"))->with('msg','Bạn đã sửa thành công');
    }
    public function create(){
        return View::make("backend.Categories.CategoriesCreate");
    }
    public function createPost(Request $request){
        $name = request("name");
        DB::table("categories")->insert(["name" => $name]);
        return redirect(url("admin/categories"))->with('msg','Bạn đã thêm thành công');

    }
    public function delete($id){
        DB::table("categories")->where("id","=",$id)->delete();
        //di chuyển đến 1 url khác
        return redirect(url("admin/categories"))->with('msg1','Bạn đã xóa thành công');
    }
}
