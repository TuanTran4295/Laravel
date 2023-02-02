<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
<h1 style="text-align: center;">Users</h1>
@if (session('msg'))
	<div class="alert alert-success table table-striped custab">{{ session('msg') }}</div>
@endif
@if (session('msg1'))
	<div class="alert alert-danger table table-striped custab" >{{ session('msg1') }}</div>
@endif
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
        @if(Auth::user()->level === 1 || Auth::user()->level === 2)
            <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new users</a>
        @endif
        <tr>
            <th class="text-center">Name</th>
            {{-- <th class="text-center">Avatar</th> --}}
            <th class="text-center">Email</th>
            @if(Auth::user()->level === 1 || Auth::user()->level === 2)
            <th class="text-center">Action</th>
            @endif
            @if(Auth::user()->level === 1)
            <th class="text-center">Roles</th>
            @endif
        </tr>
        </thead>
        @foreach ($data as $rows)
        <tr>
            <td class='text-center'>{{ $rows->name }}</td>
            {{-- <td class="text-center">
                @if($rows->avatar >0)
                    <img style="width: 100px;" src="{{ asset('upload/users/'.$rows->avatar)}}">
                @else
                    <img style="width: 100px;" src="{{ asset('https://th.bing.com/th/id/R.a1314e6b111a5a3810e2950bd0e3a2fe?rik=O%2bHLBJWZeJIInQ&pid=ImgRaw&r=0') }}">
                @endif
            </td> --}}
            <td class='text-center'>{{ $rows->email }}</td>
            @if(Auth::user()->level === 1 || Auth::user()->level === 2)
            <td class='text-center'>
                <a class='btn btn-info btn-xs' href="{{ url('admin/users/update/'.$rows->id) }} "><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                <a href="{{ url('admin/users/delete/' .$rows->id) }}" onclick="return window.confirm('Are you sure?');" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a>
                <!-- Hiển thông báo có muốn xóa không -->
                <!-- Button trigger modal -->
                {{-- <a href="" data-toggle="modal" data-target="#exampleModal" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span>Del</a> --}}
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
                            <div class="modal-body">
                                Bạn có muốn xoá không?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <a href="{{ url('admin/users/delete/' .$rows->id) }}"><button type="button" class="btn btn-primary">Xoá</button></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </td>
            @endif
            @if(Auth::user()->level === 1)
                {{-- @if($rows->level != 1)
                    <td class='text-center'>SuperAdmin</td>
                @else{ --}}
                    <td class='text-center'>
                        <form action="{{route('update_permission',$rows->id)}}" method="get">
                            {{-- Ẩn nút phân quyền của SuperAdmin --}}
                            @if($rows->level != 1)
                                <input type="checkbox"  name="permission" value="{{$rows->level}}"{{ $rows->level == 2 ? 'checked' : ''  }} >
                                <input type="submit" value="Permission" class='btn btn-info btn-xs'>
                            @else
                                <div class='text-center'>SuperAdmin</div>
                            @endif
                            {{-- <input type="checkbox"  name="permission" value="{{$rows->level}}"{{ $rows->level == 2 ? 'checked' : ''  }} >
                            <input type="submit" value="Permission" class='btn btn-info btn-xs'> --}}
                            {{-- trong laravel có thể truyền full câu lệnh sql để truy vấn --}}
                            {{-- <?php 
                                $roles = DB::select("select * from roles order by id asc")
                            ?> --}}
                            {{-- <select name="$roles">
                                @foreach($roles as $rows)
                                    <option @if(isset($record->$roles) && $record->$roles == $rows->id) selected @endif value="{{ $rows->id }}">{{ $rows->name}}</option>	
                                @endforeach		
                            </select> --}}
                        </form>
                        
                    </td>
            @endif
        </tr>
        @endforeach
    </table>
    {{-- {{ $data->render()}} --}}
</div>
@endsection
