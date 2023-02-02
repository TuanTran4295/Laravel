<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
    <h2>Thông báo</h2>
    @if (session('msg'))
        <div class="alert alert-danger table table-striped custab">{{ session('msg') }}</div>
    @endif
@endsection