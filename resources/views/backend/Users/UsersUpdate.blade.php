<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
@if (session('msg'))
	<div class="alert alert-success table table-striped custab">{{ session('msg') }}</div>
@endif
<div class="col-md-8 col-xs-offset-2">	
	<div class="panel panel-primary">
		<div class="panel-heading">Add edit user</div>
		<div class="panel-body">
		<form method="post" action="" enctype= "multipart/form-data">
		<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
		@csrf
			@if ($errors->any())
				<div class="alert alert-danger text-center">
					Vui lòng kiểm tra lại dữ liệu
				</div>
			@endif
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Name</div>
				<div class="col-md-10">
					<input type="text" value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control" >
				</div>
			</div>
			@error('name') 
				<span style="color:red;">{{ $message }}</span>
			@enderror
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Email</div>
				<div class="col-md-10">
					<input  value="{{ isset($record->email)?$record->email:'' }}" name="email" class="form-control">
				</div>
			</div>
			@error('email') 
				<span style="color:red;">{{ $message }}</span>
			@enderror
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Password</div>
				<div class="col-md-10">
					<input type="password" name="password" @if(isset($record->email)) placeholder="Không đổi password thì không nhập thông tin vào ô textbox này" @endif class="form-control">
				</div>
			</div>
			@error('password') 
				<span style="color:red;">{{ $message }}</span>
			@enderror
			<!-- end rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Avatar</div>
				<div class="col-md-10">
					<img id="mat_truoc_preview" src="{{ $record->avatar? asset('upload/users/'.$record->avatar):'https://kiemsoat.idmart.com.vn/wp-content/uploads/2019/06/icon-ng%C6%B0%E1%BB%9Di-d%C3%B9ng.png' }}" alt="your image"
							style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
					<input type="file" name="avatar" accept="image/*"
							class="form-control-file @error('photo') is-invalid @enderror" id="cmt_truoc">
				</div>
			</div>
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2"></div>
				<div class="col-md-10">
					<input type="submit" value="Process" class="btn btn-primary">
				</div>
			</div>
			<!-- end rows -->
		</form>
		</div>
	</div>
</div>
<script>
    $(function(){
        function readURL(input, selector) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $(selector).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#cmt_truoc").change(function () {
            readURL(this, '#mat_truoc_preview');
        });

    });
</script>
@endsection