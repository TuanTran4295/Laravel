<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
<h1 style="text-align: center;">Tasks</h1>
@if (session('msg'))
<div class="table table-striped custab alert alert-success">{{ session('msg') }}</div>
@endif
@if (session('msg1'))
<div class="table table-striped custab alert alert-success" style="background:#f2dede; color: #a94442;">{{ session('msg1') }}</div>
@endif
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Photo</th>
                <th class="text-center">Task</th>
                <th class="text-center">Description</th>
                @if(Auth::user()->level === 1 || Auth::user()->level === 2)
                <th class="text-center">Action</th>
                @endif
            </tr>
        </thead>
        @foreach ($keysearch as $index => $rows)
            <tr>
                <td class="text-center">{{ $index+1 }}</td>
                <td class="text-center">
                    @if($rows->photo >0)
                    <img style="width: 100px;" src="{{ asset('upload/tasks/'.$rows->photo)}}">
                    @else
                    <img style="width: 100px;" src="{{ asset('https://img1.kienthucvui.vn/uploads/2019/08/15/hinh-anh-dep-nhat-ve-da-nang_102908849.jpg') }}">
                    @endif
                </td>
                <td class="text-center">{{ $rows->title }}</td>
                <td class="text-center">{{ $rows->description }}</td>
                @if(Auth::user()->level === 1 || Auth::user()->level === 2)
                <td class='text-center'>
                    <!-- dòng lệnh tắt: đặt tên cho đường dẫn là update <a class='btn btn-info btn-xs' href="{{route('update',['id'=>$rows->id])}} "><span class="glyphicon glyphicon-edit"></span> Edit</a> -->
                    <a class='btn btn-info btn-xs' href="{{ url('admin/tasks/update/'.$rows->id) }} "><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <a href="{{ url('admin/tasks/delete/' .$rows->id) }}" onclick="return window.confirm('Are you sure?');" class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a> 
                </td>
                @endif
            </tr>
        @endforeach
    </table>
</div>

@endsection