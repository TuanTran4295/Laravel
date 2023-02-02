<!--Load file Layout.blade.php vào đây-->
@extends("backend.Layout")
@section("do-du-lieu-vao-layout")
<h1 style="text-align: center;">Create News</h1>
<form method='post' action='#' enctype= "multipart/form-data">
@csrf
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            Vui lòng kiểm tra lại dữ liệu
        </div>
    @endif
    <div class="form-group">
        <label for="name">Tiêu Đề</label>
        <input type="text" class="form-control" id="name" placeholder="Enter a name" name="name">
    </div>
    @error('name') 
        <span style="color:red;">{{ $message }}</span>
    @enderror

    <div class="form-group">
        <label for="directory">Thuộc danh mục</label>
        {{-- <input type="text" class="form-control" id="directory" placeholder="Enter a directory" name="directory"> --}}
        <?php 
            //trong laravel có thể truyền full câu lệnh sql để truy vấn
            $categories = DB::select("select * from categories order by id asc")
        ?>
        <select name="category_id">
            @foreach($categories as $rows)
            <option @if(isset($record->category_id) && $record->category_id == $rows->id) selected @endif value="{{ $rows->id }}">{{ $rows->name}}</option>	
            @endforeach		
        </select>
    </div>
    @error('directory') 
        <span style="color:red;">{{ $message }}</span>
    @enderror
    <div class="form-group">
        <label for="content">Giới thiệu</label>
        <textarea class="form-control" id="description" placeholder="Enter a description" name="description"  style="height:300px;">
            {{ isset($news->description) ? $news->description : '' }}
        </textarea>
        {{-- <input type="text" class="form-control" id="description" placeholder="Enter a description" name="description" value ="{{ isset($tasks->description)?$tasks->description:''}}"> --}}
        <script type="text/javascript">
            CKEDITOR.replace("description")
        </script>
    </div>
    <div class="form-group">
        <label for="content">Chi tiết</label>
        <textarea class="form-control" id="content" placeholder="Enter a content" name="content"  style="height:300px;">
            {{ isset($news->content) ? $news->content : '' }}
        </textarea>
        {{-- <input type="text" class="form-control" id="description" placeholder="Enter a description" name="description" value ="{{ isset($tasks->description)?$tasks->description:''}}"> --}}
        <script type="text/javascript">
            CKEDITOR.replace("content")
        </script>
    </div>
    <!-- <div class="form-group" style="margin-top:5px;">
        <label for="description">Photo</label>
        <input type="file" class="form-control" id="photo"  name="photo">
	</div> -->
    <!-- row -->
    <div class="row" style="margin-top:5px;">
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <input type="checkbox" @if(isset($record->hot) && $record->hot == 1) checked @endif name="hot" id="hot"> <label for="hot">Tin nổi bật</label>
        </div>
    </div>
    <!-- end row -->
    <div class="form-group">
        <label class="col-md-3 col-sm-4 control-label">Ảnh </label>
        <div class="col-md-9 col-sm-8">
            <div class="row">
                <div class="col-xs-6">
                    <img id="mat_truoc_preview" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                        style="max-width: 500px; height:200px; margin-bottom: 10px;" class="img-fluid"/>
                    <input type="file" name="photo" accept="image/*"
                        class="form-control-file @error('photo') is-invalid @enderror" id="cmt_truoc">
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
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