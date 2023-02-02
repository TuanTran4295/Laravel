<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//hiển thị view
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public function read(){
        $news = DB::table("news")->get();
        return View::make("backend.News.NewsRead",["news"=>$news]);
    }
    public function update(){

    }
    public function postupdate(){
        
    }
    public function create(){
        return View::make("backend.News.NewsCreate");
    }
    public function createPost(Request $request){
        $name = request("name");
        $category_id = request("category_id");
        $description = request("description");
        $content = request("content");
        $hot = request("hot") != "" ? 1 : 0;
        $photo = "";
        //neu co anh thi update anh
        if($request->hasFile("photo")){
            //Request::file("photo")->getClientOriginalName() lay ten file
            $photo = time()."_".$request->file("photo")->getClientOriginalName();
            //thuc hien upload anh
            $request->file("photo")->move("upload/news",$photo);
        }
        DB::table("news")->insert(["name" => $name, "description" => $description, "content" => $content, "photo" => $photo,"category_id" => $category_id]);
        return redirect(url("admin/news"))->with('msg','Bạn đã thêm thành công');
    }
}
