<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
<h1 style="text-align: center;">News</h1>
@if (session('msg'))
<div class="table table-striped custab alert alert-success">{{ session('msg') }}</div>
@endif
@if (session('msg1'))
<div class="table table-striped custab alert alert-success" style="background:#f2dede; color: #a94442;">{{ session('msg1') }}</div>
@endif
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
            <div style="display: flex; justify-content: space-between; width: 100%;">
                @if(Auth::user()->level === 1 || Auth::user()->level === 2)
                <a href="{{ url('admin/news/create') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Add news</a>
                @endif
                <div>
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" name="search" value="" placeholder="Nhập từ khóa tìm kiếm..." id="key" class="input-control" style="width: 200px;border-radius: 15px;">
                        <button style="margin-top:5px; border:none; margin-left:-30px;background:white; border-radius: 15px;" type="submit" > 
                            <i class="fa fa-search" onclick="return search();" ></i> 
                        </button>
                    </form>
                </div>
            </div>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Ảnh</th>
                <th class="text-center">Tiêu Đề</th>
                <th class="text-center">Thuộc danh mục</th>
                @if(Auth::user()->level === 1 || Auth::user()->level === 2)
                <th class="text-center">Action</th>
                @endif
            </tr>
        </thead>
        @foreach ($news as $index => $rows)
            <tr>
                <td class="text-center">{{ $index+1 }}</td>
                <td class="text-center">
                    @if($rows->photo >0)
                        <img style="width: 100px;" src="{{ asset('upload/news/'.$rows->photo)}}">
                    @else
                        <img style="width: 100px;" src="{{ asset('https://img1.kienthucvui.vn/uploads/2019/08/15/hinh-anh-dep-nhat-ve-da-nang_102908849.jpg') }}">
                    @endif
                </td>
                <td class="text-center">{{ $rows->name }}</td>
                <td class="text-center">
                    <?php 
						//có thể truy cập trực tiếp tại view
						$category = DB::table("categories")->where("id","=",$rows->category_id)->first();
						echo isset($category->name) ? $category->name : "";
					?>
                </td>
                @if(Auth::user()->level === 1 || Auth::user()->level === 2)
                <td class='text-center'>
                    <!-- dòng lệnh tắt: đặt tên cho đường dẫn là update <a class='btn btn-info btn-xs' href="{{route('update',['id'=>$rows->id])}} "><span class="glyphicon glyphicon-edit"></span> Edit</a> -->
                    <a class='btn btn-info btn-xs' href="{{ url('admin/news/update/'.$rows->id) }} "><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <a href="{{ url('admin/news/delete/' .$rows->id) }}" onclick="return window.confirm('Are you sure?');" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a> 
                    
                    <!-- Hiển thông báo có muốn xóa không -->
                    <!-- Button trigger modal -->
                    {{-- <a href="" wire:click="delete({{ $rows->id }})" data-toggle="modal" data-target="#exampleModal" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span>Del</a> --}}
                    <!-- Modal -->
                    {{-- <div class="modal fade" style="top:35%" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form wire:submit.prevent='delete'>
                                    <div class="modal-body">
                                        Bạn có muốn xoá không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Xoá</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </td>
                @endif
            </tr>
        @endforeach
    </table>
</div>

@endsection