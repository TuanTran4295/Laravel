<?php

namespace App\Http\Livewire;

use Livewire\Component;
//đối tượng thao tác csdl => sử dụng Query builder 
use Illuminate\Support\Facades\DB;

class ContactForm extends Component
{
    public function render()
    {
        return view('livewire.contact-form');
    }
    public function delete($id)
	{
		//lấy 1 bản ghi
		DB::table("users")->where("id", "=", $id)->delete();
		//di chuyển đến 1 url khác
		//return redirect(url("admin/users"))//không có thông báo
		return redirect(url("admin/users"))->with('msg1', 'Bạn đã xóa thành công'); //thông báo
	}
}
