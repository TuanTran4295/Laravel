<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//trong controller muốn sử dụng đối tượng nào thì phải khai báo đối tượng đó ở đây
//hiển thị view
use Illuminate\Support\Facades\View;
//đối tượng thao tác csdl => sử dụng Query builder 
use Illuminate\Support\Facades\DB;
//đối tượng mã hóa password
use Illuminate\Support\Facades\Hash;
class TasksController extends Controller
{
    //url: public/admin/users
    public function read(){
        /* 
        truy vấn dữ liệu
        DB::table("users") <=> Tác động vào bảng users
        orderBy("id","desc") <=> order by id idesc 
        paginate(4) <=> phân 4 bản ghi trên 1 trang
        */
        $tasks = DB::table("tasks")->get();
        return View::make("backend.Tasks.TasksRead",["tasks"=>$tasks]);
    }
    //update -GET, 
    public function update($id){
        //first() <=> lấy 1 bản ghi
        //lấy 1 bản ghi
        $tasks = DB::table("tasks")->where("id","=",$id)->first();
        return View::make("backend.Tasks.TasksUpdate",["tasks"=>$tasks]);
    }
    //update POST
    public function updatePost(Request $request, $id){
        $title = request("title"); // Request::get("title")
        $description = request("description");//Request::get("description")
        //update title
        DB::table("tasks")->where("id","=",$id)->update(["title"=>$title]);
        //update description
        DB::table("tasks")->where("id","=",$id)->update(["description"=>$description]);
        if($request->hasFile("photo")){
    		//---
    		//lấy ảnh củ để xóa
    		//select("photo") lấy cột photo
    		$oldPhoto = DB::table("tasks")->where("id","=",$id)->select("photo")->first();
    		if($oldPhoto->photo >0  && file_exists("upload/tasks/".$oldPhoto->photo))
    			unlink("upload/tasks/".$oldPhoto->photo);
    		//---
    		//Request::file("photo")->getClientOriginalName() lấy tên file
    		$photo = time()."_".$request->file("photo")->getClientOriginalName();
    		//thực hiện load ảnh
    		$request->file("photo")->move("upload/tasks",$photo);
    		//uploaf bản ghi
    		DB::table("tasks")->where("id","=",$id)->update(["photo"=>$photo]);
    	}
        
       //di chuyển đến 1 url khác
       return redirect(url("admin/tasks"))->with('msg','Bạn đã sửa thành công');
    }
    //create -GET, 
    public function create(){
        return View::make("backend.Tasks.TasksCreate");
    }
    //create -POST
    public function createPost(Request $request){
        $rules = [
			"title" => 'required|min:6',
			"description" => 'required',
		];
		$messages = [
			'required' => 'Trường :attribute bắt buộc phải nhập',
			'min' => 'Trường :attribute không nhỏ hơn :min ký tự'
		];
		$request->validate($rules, $messages);
        
        $title = request("title"); // Request::get("title")
        $description = request("description"); // Request::get("description")
        $photo = "";
        //neu co anh thi update anh
        if($request->hasFile("photo")){
            //Request::file("photo")->getClientOriginalName() lay ten file
            $photo = time()."_".$request->file("photo")->getClientOriginalName();
            //thuc hien upload anh
            $request->file("photo")->move("upload/tasks",$photo);
        }
        //kiểm tra xem title đã tồn tại chưa , nếu chưa tồn tại thì mới cho insert
        $countTitle = DB::table("tasks")->where("title","=",$title)->Count();
        if($countTitle == 0){
            //insert bản ghi
            DB::table("tasks")->insert(["title"=>$title,"description"=>$description, "photo"=>$photo]);
            //di chuyển đến 1 url khác
            return redirect(url("admin/tasks"))->with('msg','Bạn đã thêm thành công');
        }else{
            //di chuyển đến 1 url khác
            return redirect(url("admin/tasks?notify=titleExists"));
        }
    }
    //delete
    public function delete($id){
        //lấy ảnh củ để xóa
        //select("photo") lấy cột photo
        $oldPhoto = DB::table("tasks")->where("id","=",$id)->select("photo")->first();
        if($oldPhoto->photo > 0  && file_exists("upload/tasks/".$oldPhoto->photo))
            unlink("upload/tasks/".$oldPhoto->photo);
        DB::table("tasks")->where("id","=",$id)->delete();
        //di chuyển đến 1 url khác
        return redirect(url("admin/tasks"))->with('msg1','Bạn đã xóa thành công');
    }
    
}
