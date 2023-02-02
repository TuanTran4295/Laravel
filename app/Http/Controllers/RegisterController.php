<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation;
// sử dụng request của validator
use Illuminate\Support\Facades\Validator;
//sử dụng để xác thực mật khẩu
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function registerget(){
        return view('backend.Auth.Register');
    }
    public function registerpost(Request $request){
        $rules = [
            "name" => 'required|string|min:6',
			"email" => ['required', 'email', 'unique:users,email'],
			'password' => ['required', Password::min(8)],
            'confirmpassword' => ['required', 'same:password'],
        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute không nhỏ hơn :min ký tự',
			'email' => ':attribute chưa đúng định dạng',
			'unique' => ':attribute đã tồn tại, vui lòng nhập email khác',
			'password.min' => ':attribute không nhỏ hơn :min ký tự',
            'confirmpassword' => ':attribute không khớp',
        ];
        $attributes = [
			'name' => 'Tên user', //phần hiện lên thông báo
			'email' => 'Email',
			'password' => 'Password'
		];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) { //Nếu validate thất bại thì sẽ hiện thông báo
			$validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào');
		} else{
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
				return redirect(url("login"));
			} else {
				//di chuyển đến 1 url khác
				return redirect(url("admin/users?notify=emailExists"));
			}
		}
		return back()->withErrors($validator); // hiện các thông báo của validate
        
    }
}
