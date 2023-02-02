<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
<h1 style="text-align: center;">Edit task</h1>
<form method='post' action='#' enctype= "multipart/form-data">
@csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter a name" name="name" value ="{{ isset($categories->name)?$categories->name:''}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection