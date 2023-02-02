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
// sử dụng request của validate
use App\Http\Requests\UsersRequest;
// sử dụng request của validator
use Illuminate\Support\Facades\Validator;
//sử dụng để xác thực mật khẩu
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
	//url: public/admin/users
	public function read()
	{
		/* 
    	truy vấn dữ liệu
    	DB::table("users") <=> Tác động vào bảng users
    	orderBy("id","desc") <=> order by id idesc 
    	paginate(4) <=> phân 4 bản ghi trên 1 trang
		ASC: xếp xuôi
		desc: xếp ngược
		
    	*/
    	// $data = DB::table("users")->get();
		$data = DB::table("users")->orderBy("id", "desc")->paginate(25);
		return View::make("backend.Users.UsersRead", ["data" => $data]);
	}
	public function read_permission()
	{
		return View::make("backend.Permission");
	}
	//update -GET
	public function update($id)
	{
		//first() <=> lấy 1 bản ghi
		$record = DB::table("users")->where("id", "=", $id)->first();
		return View::make("backend.Users.UsersUpdate", ["record" => $record]);
	}
	//update -POST
	public function updatePost(Request $request,$id)
	{
		$name = request("name"); // Request::get("name")
		$email = request("email"); //Request::get("email")
		$password = request("password"); // Request::get("password")
		//update name
		DB::table("users")->where("id", "=", $id)->update(["name" => $name]);
		//update email
		DB::table("users")->where("id", "=", $id)->update(["email" => $email]);
		//Nếu password không rỗng thì update password
		
		if ($password != "") {
			//mã hóa password
			$password = Hash::make($password);
			DB::table("users")->where("id", "=", $id)->update(["password" => $password]);
		}
		if($request->hasFile("avatar")){
    		//lấy ảnh củ để xóa
    		//select("photo") lấy cột photo
    		$oldPhoto = DB::table("users")->where("id","=",$id)->select("avatar")->first();
    		if($oldPhoto->avatar >0  && file_exists("upload/users/".$oldPhoto->avatar))
    			unlink("upload/users/".$oldPhoto->avatar);
    		//Request::file("photo")->getClientOriginalName() lấy tên file
    		$avatar = time()."_".$request->file("avatar")->getClientOriginalName();
    		//thực hiện load ảnh
    		$request->file("avatar")->move("upload/users",$avatar);
    		//upload bản ghi
    		DB::table("users")->where("id","=",$id)->update(["avatar"=>$avatar]);
    	}
		
		//di chuyển đến 1 url khác
		return redirect(url("admin/users"))->with('msg', 'Bạn đã sửa thành công'); //thông báo
	}
	//create -GET
	public function create()
	{
		//first() <=> lấy 1 bản ghi
		return View::make("backend.Users.UsersCreate");
	}
	//create -POST
	public function createPost(Request $request)
	{
		$rules = [
			"name" => 'required|string|min:6',
			"email" => ['required', 'email', 'unique:users,email'],
			'password' => ['required', Password::min(8)],
			// 'password' => ['required', Password::min(8),'regex:/^[A-za-z]{3}+\d{5}/'],
		];
		$messages = [
			'required' => ':attribute bắt buộc phải nhập',
			'min' => ':attribute không nhỏ hơn :min ký tự',
			'email' => ':attribute chưa đúng định dạng',
			'unique' => ':attribute đã tồn tại, vui lòng nhập email khác',
			'password.min' => ':attribute không nhỏ hơn :min ký tự',
			'regex' => ':attribute phải nhập 3 chữ, 5 số',
		];
		$attributes = [
			'name' => 'Tên user', //phần hiện lên thông báo
			'email' => 'Email',
			'password' => 'Password'
		];
		$validator = Validator::make($request->all(), $rules, $messages, $attributes); // cú pháp của validator
		if ($validator->fails()) { //Nếu validate thất bại thì sẽ hiện thông báo
			$validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào');
		} else { // nếu validate thành công thì sẽ thực hiện việc lấy và lưu dữ liệu
			$name = request("name"); // Request::get("name")
			$email = request("email"); // Request::get("email")
			$password = request("password"); // Request::get("password")
			//mã hóa password
			$password = Hash::make($password);
			//kiểm tra xem email đã tồn tại chưa , nếu chưa tồn tại thì mới cho insert
			$countEmail = DB::table("users")->where("email", "=", $email)->Count();
			if ($countEmail == 0) {
				//insert bản ghi
				DB::table("users")->insert(["name" => $name, "email" => $email, "password" => $password]);
				// dd(1);
				//di chuyển đến 1 url khác
				return redirect(url("admin/users"))->with('msg', 'Bạn đã thêm thành công');
			} else {
				//di chuyển đến 1 url khác
				return redirect(url("admin/users?notify=emailExists"));
			}
		}

		return back()->withErrors($validator); // hiện các thông báo của validate

	}
	//delete
	public function delete($id)
	{
		//lấy 1 bản ghi
		DB::table("users")->where("id", "=", $id)->delete();
		//di chuyển đến 1 url khác
		//return redirect(url("admin/users"))//không có thông báo
		return redirect(url("admin/users"))->with('msg1', 'Bạn đã xóa thành công'); //thông báo
	}
	public function update_permission($id, Request $request)
	{
		if ($request->permission == null) {
			$user = DB::table("users")->where('id', $id)->update(["level" => 0]);
		} else {
			$user = DB::table("users")->where('id', $id)->update(["level" => 2]);
		}
		return redirect(url("admin/users"))->with('msg', 'Bạn đã phân quyền thành công'); //thông báo
	}
	public function roles_permission($id, Request $request){

	}
}
