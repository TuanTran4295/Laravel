<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
<h1 style="text-align: center;">Create Categories</h1>
<form method='post' action='#' enctype= "multipart/form-data">
@csrf
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            Vui lòng kiểm tra lại dữ liệu
        </div>
    @endif
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter a title" name="name">
    </div>
    @error('title') 
        <span style="color:red;">{{ $message }}</span>
    @enderror

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection